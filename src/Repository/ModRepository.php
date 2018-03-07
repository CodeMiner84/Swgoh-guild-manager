<?php

namespace App\Repository;

use App\Entity\Mod;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ModRepository extends ServiceEntityRepository implements RepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Mod::class);
    }

    public function remove(): void
    {
        $this->createQueryBuilder('u')
            ->delete()
            ->getQuery()
            ->execute()
        ;
    }
}
