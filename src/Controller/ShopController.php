<?php

namespace App\Controller;

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
     */
    public function index()
    {
        // replace this line with your own code!
        return $this->render('shop/index.html.twig', [
            ]);
    }
}
