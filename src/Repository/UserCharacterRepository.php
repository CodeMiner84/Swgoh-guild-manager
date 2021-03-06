<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\UserCharacter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class UserCharacterRepository.
 */
class UserCharacterRepository extends ServiceEntityRepository implements RepositoryInterface
{
    /**
     * UserCharacterRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserCharacter::class);
    }

    /**
     * @param User  $user
     * @param array $data
     *
     * @return mixed
     */
    public function updateToon(User $user, array $data)
    {
        return $this->createQueryBuilder('u')
            ->update($this->getEntityName(), 'u')
            ->set('u.stars', ':stars')
            ->set('u.level', ':level')
            ->set('u.gear', ':gear')
            ->set('u.active', ':active')
            ->set('u.power', ':power')
            ->where('u.user = :user')
            ->andWhere('u.character = :character')
            ->setParameters([
                'stars' => $data['stars'],
                'level' => $data['level'],
                'gear' => $data['gear'],
                'active' => $data['active'],
                'user' => $data['user']->getId(),
                'character' => $data['character']->getId(),
                'power' => $data['power'],
            ])
            ->getQuery()
            ->execute();
    }
}
