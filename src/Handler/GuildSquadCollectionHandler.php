<?php

namespace App\Handler;

use App\Entity\Character;
use App\Entity\GuildSquad;
use App\Entity\GuildSquadCollection;
use App\Entity\RequestTrait;
use App\Repository\GuildSquadCollectionRepository;
use App\Repository\GuildSquadRepository;
use Doctrine\ORM\QueryBuilder;

/**
 * Class GuildSquadCollectionHandler.
 */
class GuildSquadCollectionHandler extends ApiHandler
{
    use RequestTrait;

//    protected const ALLOWED_PARAMS = [
//        'name',
//    ];
//
    /**
     * @return QueryBuilder
     */
    public function convertRequest(): QueryBuilder
    {
        /** @var QueryBuilder $qb */
        $qb = $this->qb;
        $userId = $this->request->attributes->get('id');

        $alias = current($qb->getRootAliases());
        $qb->add('where',
            $qb->expr()->eq($alias.'.guildSquad', $userId)
        );

        return $qb;
    }

    public function updateCollection(GuildSquad $guildSquad, array $request, array $groups)
    {
        $data = $this->filterCollection($guildSquad);
        foreach ($request['collection'] as $characterId) {
            $code = sprintf("%s-%s", $guildSquad->getId(), $characterId);
            if (!($data[$code] ?? null)) {
                $entity = new GuildSquadCollection();
                $entity->setGuildSquad($guildSquad);
                $entity->setCharacter($this->em->getReference(Character::class, $characterId));

                $this->em->persist($entity);
            } else {
                unset($data[$code]);
            }
        }

        foreach ($data as $existed => $value) {
            $this->repository->removeCollection($existed);
        }

        $this->em->flush();
    }

    public function filterCollection(GuildSquad $guildSquad): array
    {
        $data = $this->repository->getSquadCollection($guildSquad->getId());

        $returnData = [];
        foreach ($data  as $item) {
            $returnData[$item['squad']] = 1;
        }

        return $returnData;
    }
}
