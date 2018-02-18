<?php

namespace App\Repository;

use App\Entity\Guild;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class GuildRepository.
 */
class GuildRepository extends ServiceEntityRepository implements RepositoryInterface
{
    /**
     * GuildRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Guild::class);
    }

    public function remove(): void
    {
        $this->createQueryBuilder('u')
            ->delete()
            ->getQuery()
            ->execute()
        ;
    }

    /**
     * @param int $id
     *
     * @return array
     */
    public function check(int $id): array
    {
        return $this->createQueryBuilder('s')
            ->select('CONCAT(IDENTITY(s.guildSquad),CONCAT(\'-\', IDENTITY(s.character))) as squad')
            ->where('s.guildSquad = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getArrayResult()
            ;
    }
}
