<?php

namespace App\Controller\API;

use App\Entity\AccountMods;
use App\Entity\Mod;
use App\Handler\AccountModHandler;
use App\Handler\ModHandler;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\Model;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/api/mod")
 */
class ModController extends FOSRestController
{
    /**
     * @Route("/settings", name="api_mods_settings")
     * @Method("GET")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Get mods settings",
     * )
     * @SWG\Tag(name="mods")
     */
    public function settings()
    {
        return JsonResponse::create($this->getHandler()->getConfig());
    }

    /**
     * @Route("/generate", name="api_mods_generate")
     * @Method("GET")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Generate mods",
     * )
     * @SWG\Tag(name="mods")
     */
    public function generate()
    {
        return JsonResponse::create($this->getAccountModsHandler()->generate());
    }

    /**
     * @Route("/get", name="api_mods_get_account_mods")
     * @Method("GET")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Get user mods settings",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=AccountMods::class, groups={"account_mods"})
     *     )
     * )
     * @SWG\Tag(name="account_mods")
     */
    public function cget()
    {
        return $this->getAccountModsHandler()->collect(['account_mods']);
    }

    /**
     * @Route("/save", name="api_mods_save")
     * @Method("POST")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Save user mods",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=AccountMods::class, groups={"account_mods"})
     *     )
     * )
     * @SWG\Tag(name="account_mods")
     */
    public function post(Request $request)
    {
        return $this->getAccountModsHandler()->saveUserMods($request->request->all(), ['account_mods']);
    }

    public function getHandler()
    {
        return $this->get(ModHandler::class)->init(Mod::class);
    }

    public function getAccountModsHandler()
    {
        return $this->get(AccountModHandler::class)->init(AccountMods::class);
    }
}
