<?php

namespace App\Repository;

use App\Entity\ModType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ModTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ModType::class);
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
