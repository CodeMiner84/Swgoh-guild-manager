<?php

namespace App\Handler;

use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Class UserCharacterHandler.
 */
class UserCharacterHandler extends ApiHandler
{
    private const USER_ID_PARAM = 'userId';

    private const ACCEPTED_PARAMS = [self::USER_ID_PARAM];

    /**
     * @return QueryBuilder
     */
    public function convertRequest(): QueryBuilder
    {
        /** @var QueryBuilder $qb */
        $qb = $this->qb;

        $alias = current($qb->getRootAliases());
        foreach ($this->getParams() as $param => $value) {
            if (in_array($param, self::ACCEPTED_PARAMS, true)) {
                switch ($param) {
                    case self::USER_ID_PARAM:
                        $qb->add('where', ($qb->expr()->eq($alias.'.user', ':user')));
                        $qb->setParameter('user', $value);
                        break;
                }
            } else {
                throw new Exception('WRONG PARAMETER SEND');
            }
        }

        return $qb;
    }
}
