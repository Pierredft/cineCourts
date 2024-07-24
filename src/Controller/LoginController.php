<?php

namespace App\Controller;

use App\Form\LoginFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
    {
        #[Route('/login', name: 'app_login')]
        public function login(AuthenticationUtils $authenticationUtils): Response
        {
            // get the login error if there is one
            $error = $authenticationUtils->getLastAuthenticationError();
            // last username entered by the user
            $lastUsername = $authenticationUtils->getLastUsername();
    
            // $form = $this->createForm(LoginFormType::class, [
            //     'username' => $lastUsername,
            // ]);
    
            return $this->render('login/login.html.twig', [
                'lastUsername' => $lastUsername,
                'error' => $error,
            ]);
        }
    
        #[Route('/logout', name: 'app_logout')]
        public function logout(): void
        {
            // controller can be blank: it will never be executed!
            throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
        }
    }
