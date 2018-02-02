<?php

namespace App\Repository;

use App\Entity\Guild;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class UserRepository.
 */
class UserRepository extends ServiceEntityRepository implements RepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @param Guild $guild
     */
    public function removeFromGuild(Guild $guild): void
    {
        $this->createQueryBuilder('u')
            ->delete()
            ->where('u.guild = :guild')->setParameter('guild', $guild)
            ->getQuery()
            ->execute()
        ;
    }
}
