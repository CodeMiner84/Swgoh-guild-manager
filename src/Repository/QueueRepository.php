<?php

namespace App\Repository;

use App\Entity\Queue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class QueueRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Queue::class);
    }

    public function checkQueue($command, $accountId)
    {
        $date = new \DateTime();
        $date->modify('-3 hours');

        return $this->createQueryBuilder('q')
            ->where('q.command = :command')
            ->andWhere('q.account = :account')
            ->andWhere('q.finished = 0')
            ->setParameter('command', $command)
            ->setParameter('account', $accountId)
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
        ;
    }
}
