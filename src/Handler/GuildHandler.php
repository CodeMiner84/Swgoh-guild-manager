<?php

namespace App\Handler;

use App\Entity\RequestTrait;
use Doctrine\ORM\QueryBuilder;

/**
 * Class GuildHandler.
 */
class GuildHandler extends ApiHandler
{
    use RequestTrait;

    /**
     * @return QueryBuilder
     */
    public function convertRequest(): QueryBuilder
    {
        /** @var QueryBuilder $qb */
        $qb = $this->qb;
        $guildId = $this->request->attributes->get('guildId');
        $guildCode = $this->request->attributes->get('guildCode');

        $alias = current($qb->getRootAliases());
        if ($guildId && $guildCode) {
            $qb->andWhere($alias.'.uuid = :guildId');
            $qb->andWhere($alias.'.code = :guildCode');
            $qb->setParameters([
                'guildId' => $guildId,
                'guildCode' => $guildCode,
            ])
            ->setMaxResults(1);
        }

        return $qb;
    }
}
