<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController{

    /**
     * @Route("/login", name="login")
     */
    public function index(AuthenticationUtils $authenticationUtils): Response {
        $lastUsername = $authenticationUtils->getLastUsername();
        $lastAuthenticationError = $authenticationUtils->getLastAuthenticationError();
        return $this->render('security/login.html.twig',[
            'lastUsername' => $lastUsername,
            'lastAuthenticationError' => $lastAuthenticationError
        ]);
    }


       /**
     * @Route("/forgotPassword", name="forgot_password")
     */
    public function forgotPassword(): Response {
  
        return $this->render('security/fail_login.html.twig');
    }

}




