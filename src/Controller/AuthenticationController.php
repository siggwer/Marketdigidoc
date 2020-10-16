<?php

namespace App\Controller;

use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * class AuthenticationController.
 */
class AuthenticationController extends AbstractController
{
    
    /**
     * @Route("/login", name="security_login")
     *
     * @param AuthenticationUtils $authenticationUtils
     * 
     * @return void
     */
    public function login(AuthenticationUtils $authenticationUtils) :Response 
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    public function logout()
    {
    }
}