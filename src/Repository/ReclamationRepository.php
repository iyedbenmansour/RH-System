<?php

namespace App\Repository;

use App\Entity\Reclamation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @extends ServiceEntityRepository<Reclamation>
 *
 * @method Reclamation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reclamation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reclamation[]    findAll()
 * @method Reclamation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReclamationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reclamation::class);
    }

    public function save(Reclamation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Reclamation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
    //     * @return Reclamation[] Returns an array of Reclamation objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Reclamation
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    /**
     * Trouve les réclamations par statut
     */
    public function findByStatus(string $status): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.statueOfReclamation = :status')
            ->setParameter('status', $status)
            ->orderBy('r.date', 'DESC')
            ->getQuery()
            ->getResult();
    }
    public function findByStatuses(array $statuses): array
{
    return $this->createQueryBuilder('r')
        ->where('r.statueOfReclamation IN (:statuses)')
        ->setParameter('statuses', $statuses)
        ->orderBy('r.date', 'DESC')
        ->getQuery()
        ->getResult();
}
    
    /**
     * Trouve les réclamations par utilisateur
     */
    public function findByUserId(int $userId): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.userId = :userId')
            ->setParameter('userId', $userId)
            ->orderBy('r.date', 'DESC')
            ->getQuery()
            ->getResult();
    }
    
    /**
     * Trouve les réclamations par entreprise
     */
    public function findByCompanyId(int $companyId): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.companyId = :companyId')
            ->setParameter('companyId', $companyId)
            ->orderBy('r.date', 'DESC')
            ->getQuery()
            ->getResult();
    }
    
    /**
     * Recherche de réclamations par mot clé dans le titre ou la description
     */
    public function searchByKeyword(string $keyword): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.title LIKE :keyword OR r.description LIKE :keyword')
            ->setParameter('keyword', '%' . $keyword . '%')
            ->orderBy('r.date', 'DESC')
            ->getQuery()
            ->getResult();
    }
    
    /**
     * Statistiques des réclamations par statut
     */
    public function getReclamationStats(): array
    {
        $statuses = ['Not Treated', 'In Progress', 'Resolved', 'Rejected'];
        $stats = array_fill_keys($statuses, 0);
        $stats['total'] = 0;
        
        $results = $this->createQueryBuilder('r')
            ->select('r.statueOfReclamation, COUNT(r.id) as count')
            ->groupBy('r.statueOfReclamation')
            ->getQuery()
            ->getResult();
            
        foreach ($results as $result) {
            $status = $result['statueOfReclamation'];
            $count = $result['count'];
            
            if (isset($stats[$status])) {
                $stats[$status] = $count;
            }
            
            $stats['total'] += $count;
        }
        
        return $stats;
    }
    
    /**
     * Compte les réclamations par période
     */
    public function countByPeriod(\DateTime $startDate, \DateTime $endDate): int
    {
        return $this->createQueryBuilder('r')
            ->select('COUNT(r.id)')
            ->andWhere('r.date >= :startDate')
            ->andWhere('r.date <= :endDate')
            ->setParameter('startDate', $startDate)
            ->setParameter('endDate', $endDate)
            ->getQuery()
            ->getSingleScalarResult();
    }
    
    /**
     * Trouve les réclamations les plus récentes
     */
    public function findLatest(int $limit = 5): array
    {
        return $this->createQueryBuilder('r')
            ->orderBy('r.date', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
    
    /**
     * Find all reclamations with their responses loaded
     */
    public function findAllWithResponses(): array
    {
        return $this->createQueryBuilder('r')
            ->leftJoin('r.reponses', 'rep')
            ->addSelect('rep')
            ->orderBy('r.date', 'DESC')
            ->getQuery()
            ->getResult();
    }
    
    /**
     * Find one reclamation with its responses
     */
    public function findOneWithResponses(int $id): ?Reclamation
    {
        return $this->createQueryBuilder('r')
            ->leftJoin('r.reponses', 'rep')
            ->addSelect('rep')
            ->andWhere('r.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }


public function getArchivedQuery(array $statuses, ?string $statut, ?string $search)
{
    $qb = $this->createQueryBuilder('r')
        ->where('r.statueOfReclamation IN (:statuses)')
        ->setParameter('statuses', $statuses);

    if ($statut) {
        $qb->andWhere('r.statueOfReclamation = :statut')
           ->setParameter('statut', $statut);
    }

    if ($search) {
        $qb->andWhere('r.title LIKE :search OR r.description LIKE :search')
           ->setParameter('search', '%'.$search.'%');
    }

    $qb->orderBy('r.date', 'DESC');

    return $qb->getQuery();
}

public function findNotTreatedQuery(?string $search = null): Query
{
    $qb = $this->createQueryBuilder('r')
        ->where('r.statueOfReclamation = :status')
        ->setParameter('status', 'Not Treated')
        ->orderBy('r.date', 'DESC');

    if ($search) {
        $qb->andWhere('r.title LIKE :search OR r.description LIKE :search')
           ->setParameter('search', '%'.$search.'%');
    }

    return $qb->getQuery();
}
}
