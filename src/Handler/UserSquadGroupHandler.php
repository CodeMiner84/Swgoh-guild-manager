<?php

namespace App\Handler;

use App\Entity\RequestTrait;
use App\Entity\UserSquadGroup;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;

/**
 * Class UserSquadGroupHandler.
 */
class UserSquadGroupHandler extends ApiHandler
{
    use RequestTrait;

    protected const ALLOWED_PARAMS = [
        'name',
        'type',
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
     * @param UserSquadGroup $userSquadGroup
     *
     * @return UserSquadGroupHandler
     */
    public function remove(UserSquadGroup $userSquadGroup): self
    {
        if ($userSquadGroup->getAccount() === $this->user) {
            $this->em->remove($userSquadGroup);
            $this->em->flush();
        } else {
            throw new AccessDeniedException();
        }

        return $this;
    }
}
