<?php

namespace App\Handler;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use FOS\RestBundle\View\View;
use FOS\RestBundle\View\ViewHandlerInterface;
use Pagerfanta\Pagerfanta;
use Symfony\Component\HttpFoundation\Request;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class ApiHandler
 *
 * @package App\Handler
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
        $phrase = $this->request->query->all('phrase', null);

        $alias = current($qb->getRootAliases());
        if (isset($phrase['phrase'])) {
            $qb->add('where',
                $qb->expr()->like($alias.'.name', $qb->expr()->literal('%' . $phrase['phrase'] . '%'))
            );
        }

        return $qb;
    }
}
