<?php

/*
 * This file is part of the Symfony package.
 * (c) Fabien Potencier <fabien@symfony.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller\API;

use App\Entity\Account;
use App\Exception\DuplicateUserException;
use App\Repository\AccountRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class SecurityController.
 */
class SecurityController extends AbstractController
{
    /**
     * @Route("/api/logout", name="security_logout")
     */
    public function logout(): void
    {
    }

    /**
     * @Route("/api/register", name="user_registration")
     */
    public function register(
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder,
        AccountRepository $accountRepository
    ) {
        if ($accountRepository->findOneBy(['email' => $request->request->get('email')]) ||
            $accountRepository->findOneBy(['username' => $request->request->get('username')])) {
            throw new DuplicateUserException();
        }

        $user = new Account();
        $user->setEmail($request->request->get('email'))
            ->setUsername($request->request->get('username'))
            ->setRoles(['ROLE_USER']);

        $password = $passwordEncoder->encodePassword($user, $request->request->get('password'));
        $user->setPassword($password);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        $jwtManager = $this->container->get('lexik_jwt_authentication.jwt_manager');

        return JsonResponse::create([
            'success' => true,
            'token' => $jwtManager->create($user),
        ]);
    }
}
