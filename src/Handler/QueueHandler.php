<?php

namespace App\Handler;

use App\Entity\Queue;
use App\Entity\RequestTrait;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;

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

    public function addQueue(string $type)
    {
        $queue = new Queue();

        $command = null;
        switch ($type) {
            case 'mod':
                $command = 'swgoh:mods:user ' . $this->getUserAlias();
                break;
        }

        if ($this->repository->checkQueue($command, $this->user->getId())) {
        return JsonResponse::create([
            'success' => false,
            'message' => 'Action is already runing',
        ]);
        }

        $queue->setCommand($command)
            ->setAccount($this->user)
            ->setEntity('MOD')
            ->setFinished(0)
            ;

        $this->em->persist($queue);
        $this->em->flush();

        return JsonResponse::create([
            'success' => true,
            'message' => 'Action added',
        ]);
    }

    public function getUserAlias()
    {
        return $this->user->getUUid();
    }
}
