<?php

namespace App\Repository;

use App\Entity\ReponseReclamation;
use App\Entity\Reclamation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ReponseReclamation>
 */
class ReponseReclamationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReponseReclamation::class);
    }

    public function save(ReponseReclamation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ReponseReclamation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Find responses by reclamation ID
     * 
     * @param int $reclamationId The ID of the reclamation
     * @return ReponseReclamation[] Array of responses
     */
    public function findByReclamation(int $reclamationId): array
    {
        return $this->createQueryBuilder('r')
            ->join('r.reclamation', 'rec')
            ->andWhere('rec.id = :reclamationId')
            ->setParameter('reclamationId', $reclamationId)
            ->orderBy('r.date', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Find responses by reclamation entity
     * 
     * @param Reclamation $reclamation The reclamation entity
     * @return ReponseReclamation[] Array of responses
     */
    public function findByReclamationEntity(Reclamation $reclamation): array
    {
        return $this->findBy(['reclamation' => $reclamation], ['date' => 'DESC']);
    }

    //    /**
    //     * @return ReponseReclamation[] Returns an array of ReponseReclamation objects
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

    //    public function findOneBySomeField($value): ?ReponseReclamation
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
