<?php

namespace App\Controller;

use App\Service\AesTest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * App login method with email and password
     *
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
             return $this->redirectToRoute('profile_index');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    /**
     * App logout method with redirect to login
     *
     * @Route("/logout", name="app_logout")
     */
    public function logout(): RedirectResponse
    {
        return new RedirectResponse('/login');
    }

    /**
     * @Route("/test-aes")
     * @param AesTest $aesTest
     * @return Response
     */
    public function testCipher(AesTest $aesTest): Response
    {
        $encrypted = $aesTest->encrypt('Pasha yebany pidar', 'qwerty');
        $decrypted = $aesTest->decrypt($encrypted, 'qwerty');
        dd($encrypted, $decrypted);
    }
}
