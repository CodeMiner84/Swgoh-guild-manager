<?php

namespace App\Handler;

use App\Entity\GuildSquad;
use App\Entity\RequestTrait;
use Doctrine\ORM\QueryBuilder;

/**
 * Class GuildSquadHandler.
 */
class GuildSquadHandler extends ApiHandler
{
    use RequestTrait;

    protected const ALLOWED_PARAMS = [
        'name',
        'fullSquad',
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

    public function remove(GuildSquad $guildSquad)
    {
        $this->em->remove($guildSquad);
        $this->em->flush();

        return $this;
    }
}
