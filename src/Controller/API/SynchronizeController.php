<?php

namespace App\Controller\API;

use App\Entity\Guild;
use App\Entity\Queue;
use App\Entity\User;
use App\Handler\ApiHandler;
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

    public function getHandler()
    {
        return $this->get(QueueHandler::class)->init(Queue::class);
    }
}
