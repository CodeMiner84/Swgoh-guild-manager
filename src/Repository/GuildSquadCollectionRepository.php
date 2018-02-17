<?php

namespace App\Repository;

use App\Entity\GuildSquadCollection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class GuildSquadCollectionRepository.
 */
class GuildSquadCollectionRepository extends ServiceEntityRepository
{
    /**
     * GuildSquadCollectionRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, GuildSquadCollection::class);
    }

    /**
     * @param int $id
     *
     * @return array
     */
    public function getSquadCollection(int $id): array
    {
        return $this->createQueryBuilder('s')
            ->select('CONCAT(IDENTITY(s.guildSquad),CONCAT(\'-\', IDENTITY(s.character))) as squad')
            ->where('s.guildSquad = :id')
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
        list($guildSquadId, $characterId) = explode('-', $code);

        $this->createQueryBuilder('c')
            ->delete(GuildSquadCollection::class, 'c')
            ->where('c.character = :characterId')
            ->andWhere('c.guildSquad = :guildSquadId')
            ->setParameters([
                'guildSquadId' => $guildSquadId,
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
            ->select('IDENTITY(s.character) as character, IDENTITY(s.guildSquad) as squad')
            //->join('s.character', 'c')
            ->where('s.guildSquad = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getArrayResult()
            ;
    }
}
