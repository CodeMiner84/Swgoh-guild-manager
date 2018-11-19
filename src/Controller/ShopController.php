<?php

namespace App\Controller;

use App\Entity\User;
use App\Utils\API\ApiConnector;
use App\Utils\API\UnitData;
use App\Utils\API\UserData;
use App\Utils\CharacterCrawler;
use App\Utils\ModCrawler;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShopController extends Controller
{
    /**
     * @Route("/test", name="test")
     * @Route("/login", name="app_login")
     * @Route("/register", name="app_register")
     * @Route("/logout", name="app_logout")
     * @Route("/account", name="app_account")
     * @Route("/collection", name="app_collection")
     * @Route("/shop", name="guilds")
     * @Route("/guild", name="guild")
     * @Route("/guilds", name="guilds")
     * @Route("/users/{code}", name="users")
     * @Route("/users", name="users")
     * @Route("/characters", name="characters")
     * @Route("/guild-squads", name="guild_squads")
     * @Route("/guild-squads/{action}", name="guild_squads_option")
     * @Route("/guild-squads/{action}/builder", name="guild_squads_builder")
     * @Route("/user/{code}", name="user-characters")
     * @Route("/user-squad-group", name="user-squad-group")
     * @Route("/user-squad-group/add", name="user-squad-group-add")
     * @Route("/user-squad-group/edit/{id}", name="user-squad-group-edit")
     * @Route("/user-squad/{squad}", name="user-squad")
     * @Route("/user-squad/{squad}/{action}", name="action-squad")
     * @Route("/user-squad/{squad}/{action}/{id}", name="action-squad-edit")
     * @Route("/mods", name="mdos")
     */
    public function index(ApiConnector $apiConnector, UserData $userData, ModCrawler $modCrawler)
    {
        $userData->fetchUser(254583433);
        die("A");
        $user = $this->getDoctrine()->getRepository(User::class)->find(1);
        $userData->crawl();
        die;
        $apiConnector->connect();
        $unitData->fetchUnits();
        die;
        // replace this line with your own code!
        return $this->render('shop/index.html.twig', [
            ]);
    }
}
