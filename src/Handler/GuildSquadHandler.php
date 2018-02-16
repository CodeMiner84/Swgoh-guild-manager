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
 * Class GuildSquadHandler.
 */
class GuildSquadHandler extends ApiHandler
{
    use RequestTrait;

    protected const ALLOWED_PARAMS = [
        'name',
    ];

    /**
     * @return QueryBuilder
     */
    public function convertRequest(): QueryBuilder
    {
        /** @var QueryBuilder $qb */
        $qb = $this->qb;
        $userId = $this->user->getId();

        $alias = current($qb->getRootAliases());
        $qb->add('where',
            $qb->expr()->eq($alias.'.account', $userId)
        );

        $qb->orderBy(sprintf('%s.name', $alias));

        return $qb;
    }

//    public function updateCollection(GuildSquad $guildSquad, array $request, array $groups)
//    {
//        $repository = $this->em->getRepository(GuildSquadCollection::class);
//        $data = $this->filterCollection($guildSquad, $repository);
//        foreach ($request['collection'] as $characterId) {
//            $code = sprintf("%s-%s", $guildSquad->getId(), $characterId);
//            if (!($data[$code] ?? null)) {
//                $entity = new GuildSquadCollection();
//                $entity->setGuildSquad($guildSquad);
//                $entity->setCharacter($this->em->getReference(Character::class, $characterId));
//
//                $this->em->persist($entity);
//            } else {
//                unset($data[$code]);
//            }
//        }
//
//        foreach ($data as $existed => $value) {
//            $repository->removeCollection($existed);
//        }
//
//        $this->em->flush();
//    }
//
//    public function filterCollection(GuildSquad $guildSquad, GuildSquadCollectionRepository $guildSquadRepository): array
//    {
//        $data = $guildSquadRepository->getSquadCollection($guildSquad->getId());
//
//        $returnData = [];
//        foreach ($data  as $item) {
//            $returnData[$item['squad']] = 1;
//        }
//
//        return $returnData;
//    }
}
