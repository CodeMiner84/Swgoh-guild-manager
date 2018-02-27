<?php

namespace App\Repository;

use App\Entity\UserSquadCollection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class UserSquadCollectionRepository.
 */
class UserSquadCollectionRepository extends ServiceEntityRepository
{
    /**
     * UserSquadCollectionRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserSquadCollection::class);
    }

    /**
     * @param int $id
     *
     * @return array
     */
    public function getSquadDiff(int $groupId, int $squadId): array
    {
        return $this->createQueryBuilder('s')
            ->select('IDENTITY(s.character) as character')
            ->join('s.userSquad', 'squad')
            ->where('s.userSquad NOT IN (:squadId)')
            ->andWhere('squad.group = :groupId')
            ->setParameter('squadId', $squadId)
            ->setParameter('groupId', $groupId)
            ->getQuery()
            ->getArrayResult()
            ;
    }

    /**
     * @param int $id
     *
     * @return array
     */
    public function getSquadCollection(int $id): array
    {
        return $this->createQueryBuilder('s')
            ->select('CONCAT(IDENTITY(s.userSquad),CONCAT(\'-\', IDENTITY(s.character))) as squad')
            ->where('s.userSquad = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getArrayResult()
            ;
    }

    /**
     * @param string $code
     */
    public function removeCollection(string $code): void
    {
        list($userSquadId, $characterId) = explode('-', $code);

        $this->createQueryBuilder('c')
            ->delete(UserSquadCollection::class, 'c')
            ->where('c.character = :characterId')
            ->andWhere('c.userSquad = :userSquadId')
            ->setParameters([
                'userSquadId' => $userSquadId,
                'characterId' => $characterId,
            ])
            ->getQuery()
            ->execute();
    }

    /**
     * @param int $characterId
     * @param int $squadId
     *
     * @return array
     */
    public function checkSquad(int $characterId, int $squadId): array
    {
        return $this->createQueryBuilder('s')
            ->select('IDENTITY(s.character) as character, IDENTITY(s.userSquad) as squad')
            ->where('s.userSquad = :id')
            ->setParameter('id', $squadId)
            ->getQuery()
            ->getArrayResult()
            ;
    }
}
