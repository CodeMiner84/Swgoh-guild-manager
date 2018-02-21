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
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class SecurityController.
 */
class SecurityController extends AbstractController
{
    /**
     * @Route("/api/login", name="security_logousst")
     */
    public function login(JWTTokenManagerInterface $interface): void
    {
        $interface;

        die('A');
    }

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
        AccountRepository $accountRepository,
        JWTTokenManagerInterface $interface
    ) {
        if ($accountRepository->findOneBy(['email' => $request->request->get('email')]) ||
            $accountRepository->findOneBy(['username' => $request->request->get('username')])) {
            return JsonResponse::create([
                'message' => 'Error! Username already exist',
                'code' => Response::HTTP_BAD_REQUEST,
                'success' => false,
            ], 404);
        }
        if (!$request->request->get('email') || !$request->request->get('username') || !$request->request->get('password')) {
            return JsonResponse::create([
                'message' => 'Error! All data required',
                'code' => Response::HTTP_BAD_REQUEST,
                'success' => false,
            ], 404);
        }
        if (!filter_var($request->request->get('email'), FILTER_VALIDATE_EMAIL)) {
            return JsonResponse::create([
                'message' => 'Error! E-mail is wrong!',
                'code' => Response::HTTP_BAD_REQUEST,
                'success' => false,
            ], 404);
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

        return JsonResponse::create([
            'success' => true,
            'token' => $interface->create($user),
        ]);
    }
}
