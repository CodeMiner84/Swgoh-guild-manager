<?php

namespace App\Repository;

use App\Entity\Character;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class CharacterRepository
 * @package App\Repository
 */
class CharacterRepository extends ServiceEntityRepository implements RepositoryInterface
{
    /**
     * CharacterRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Character::class);
    }

    /**
     * @param $qb
     * @param string $phrase
     *
     * @return QueryBuilder
     */
    public function findByPhrase($qb, string $phrase): QueryBuilder
    {
        return $qb->andWhere('name = :phrase')
            ->setParameter('phrase', $phrase)
            ;
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
