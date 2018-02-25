<?php

namespace App\Handler;

use App\Entity\RequestTrait;
use App\Entity\UserSquad;
use Doctrine\ORM\QueryBuilder;

/**
 * Class UserSquadHandler.
 */
class UserSquadHandler extends ApiHandler
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

    /**
     * @param UserSquad $userSquad
     *
     * @return UserSquadHandler
     */
    public function remove(UserSquad $userSquad): self
    {
        $this->em->remove($userSquad);
        $this->em->flush();

        return $this;
    }
}
