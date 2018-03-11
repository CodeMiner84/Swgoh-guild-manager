<?php

namespace App\Handler;

use App\Entity\AccountMods;
use Doctrine\ORM\QueryBuilder;

/**
 * Class AccountModHandler.
 */
class AccountModHandler extends ApiHandler
{
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

        return $qb;
    }

    /**
     * @param array $params
     * @param array $groups
     */
    public function saveUserMods(array $params, array $groups)
    {
        if ($accountMods = $this->repository->findOneByAccount($this->user->getId())) {
            $accountMods->setMods(json_encode($params));
            $this->em->flush();
        } else {
            $accountMods = new AccountMods();
            $accountMods->setAccount($this->user);
            $accountMods->setMods(json_encode($params));

            $this->em->persist($accountMods);
            $this->em->flush();
        }

        $view = $this->createView(
            $accountMods,
            $groups
        );

        return $this->viewhandler->createResponse($view, $this->request, 'json');
    }
}
