<?php

namespace App\Handler;

use App\Entity\Queue;
use App\Entity\RequestTrait;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class GuildHandler.
 */
class QueueHandler extends ApiHandler
{
    use RequestTrait;

    /**
     * @return QueryBuilder
     */
    public function convertRequest(): QueryBuilder
    {
        $qb = $this->qb;
        $userId = $this->user->getId();

        $alias = current($qb->getRootAliases());
        $qb->add('where',
            $qb->expr()->eq($alias.'.account', $userId)
        );

        return $qb;
    }

    /**
     * @param string $type
     *
     * @return JsonResponse
     */
    public function addQueue(string $type): JsonResponse
    {
        $queue = new Queue();

        $command = null;
        $entity = null;
        $params = [];
        switch ($type) {
            case 'mod':
                $command = 'swgoh:mods:user';
                $entity = 'Mod';
                $params['code'] = $this->getUserAlias();
                break;
            case 'user':
                $entity = 'UserCharacter';
                $command = 'swgoh:user:characters';
                $params['code'] = $this->getUserAlias();
                break;
        }

        if ($this->repository->checkQueue($command, $this->user->getId())) {
        return JsonResponse::create([
            'success' => false,
            'code' => Response::HTTP_BAD_REQUEST,
            'message' => 'Action is already runing',
        ]);
        }

        $queue->setCommand($command)
            ->setAccount($this->user)
            ->setEntity($entity)
            ->setParams($params)
            ->setFinished(0)
            ;

        $this->em->persist($queue);
        $this->em->flush();

        return JsonResponse::create([
            'success' => true,
            'code' => Response::HTTP_OK,
            'message' => 'Action added',
        ]);
    }

    public function getUserAlias()
    {
        return $this->user->getUUid();
    }
}
