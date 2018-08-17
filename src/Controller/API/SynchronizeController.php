<?php

namespace App\Controller\API;

use App\Entity\Queue;
use App\Entity\User;
use App\Handler\QueueHandler;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\Model;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Swagger\Annotations as SWG;

/**
 * @Route("/api/synchronize")
 */
class SynchronizeController extends FOSRestController
{
    /**
     * @Route("/mod", name="api_synchronize_mods")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Fetch user mods",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=Queue::class, groups={"queue_mods"})
     *     )
     * )
     * @SWG\Tag(name="queue_mods")
     */
    public function getMods()
    {
        return $this->getHandler()->addQueue('mod');
    }

    /**
     * @Route("/account", name="api_synchronize_user")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Sync user",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=Queue::class, groups={"queue_user"})
     *     )
     * )
     * @SWG\Tag(name="queue_user")
     */
    public function postSyncUser()
    {
        return $this->getHandler()->addQueue('user');
    }

    public function getHandler()
    {
        return $this->get(QueueHandler::class)->init(Queue::class);
    }
}
