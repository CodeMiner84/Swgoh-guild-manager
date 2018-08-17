<?php

namespace App\Handler;

use App\Entity\Character;
use App\Entity\RequestTrait;
use App\Entity\UserSquad;
use App\Entity\UserSquadCollection;
use App\Entity\UserSquadGroup;
use Doctrine\ORM\QueryBuilder;

/**
 * Class UserSquadCollectionHandler.
 */
class UserSquadCollectionHandler extends ApiHandler
{
    use RequestTrait;

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
            $qb->expr()->eq($alias.'.userSquad', $userId)
        );

        return $qb;
    }

    public function getCollection(UserSquadGroup $userSquadGroup, UserSquad $userSquad, array $groups)
    {
        $diff = $this->filterDiff($userSquadGroup, $userSquad);

        $view = $this->createView(
            $this->transformIterator($this->getPaginatedResult()),
            $groups
        );
        $view->setData([
            'data' => $view->getData()['data'],
            'diff' => $diff,
        ]);

        return $this->viewhandler->createResponse($view, $this->request, 'json');
    }

    public function updateCollection(UserSquad $userSquad, array $request, array $groups)
    {
        $data = $this->filterCollection($userSquad);
        foreach ($request['collection'] as $characterId) {
            $code = sprintf('%s-%s', $userSquad->getId(), $characterId);
            if (!($data[$code] ?? null)) {
                $entity = new UserSquadCollection();
                $entity->setUserSquad($userSquad);
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

    public function filterCollection(UserSquad $userSquad): array
    {
        $data = $this->repository->getSquadCollection($userSquad->getId());

        $returnData = [];
        foreach ($data  as $item) {
            $returnData[$item['squad']] = 1;
        }

        return $returnData;
    }

    public function filterDiff(UserSquadGroup $userSquadGroup, UserSquad $userSquad): array
    {
        $character = $this->repository->getSquadDiff($userSquadGroup->getId(), $userSquad->getId());

        $characters = [];
        foreach ($character as $char) {
            $characters[$char['character']] = $char['character'];
        }

        return $characters;
    }
}
