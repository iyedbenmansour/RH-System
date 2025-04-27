<?php
// src/Repository/EventRepository.php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Event>
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

    public function save(Event $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Event $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    // Example custom query method
    public function findUpcomingEvents(): array
    {
        return $this->createQueryBuilder('e')
            ->where('e.date >= :today')
            ->setParameter('today', new \DateTime())
            ->orderBy('e.date', 'ASC')
            ->getQuery()
            ->getResult();
    }
    public function findEventsBetweenDates(\DateTimeInterface $startDate, \DateTimeInterface $endDate): array
{
    return $this->createQueryBuilder('e')
        ->where('e.date BETWEEN :start AND :end')
        ->setParameter('start', $startDate->format('Y-m-d'))
        ->setParameter('end', $endDate->format('Y-m-d'))
        ->orderBy('e.date', 'ASC')
        ->getQuery()
        ->getResult();
}
}