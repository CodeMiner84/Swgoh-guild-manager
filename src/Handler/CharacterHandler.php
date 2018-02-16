<?php

namespace App\Handler;

use Doctrine\ORM\QueryBuilder;

/**
 * Class ApiHandler.
 */
class CharacterHandler extends ApiHandler
{
    /**
     * @return QueryBuilder
     */
    public function convertRequest(): QueryBuilder
    {
        /** @var QueryBuilder $qb */
        $qb = $this->qb;
        $phrase = $this->request->query->get('phrase', null);

        $alias = current($qb->getRootAliases());
        if (isset($phrase['phrase'])) {
            $qb->add('where',
                $qb->expr()->like($alias.'.name', $qb->expr()->literal('%'.$phrase['phrase'].'%'))
            );
        }

        return $qb;
    }
}
