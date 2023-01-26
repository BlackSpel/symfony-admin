<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->isGranted('IS_AUTHENTICATED')) {
            $this->addFlash('warning', 'User already login');
            return $this->redirectToRoute('index');
        }

         // get the login error if there is one
         $error = $authenticationUtils->getLastAuthenticationError();

         // last username entered by the user
         $lastUsername = $authenticationUtils->getLastUsername();
        
        return $this->render('@EasyAdmin/page/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,

            'page_title' => 'Symfony admin',
            'csrf_token_intention' => 'authenticate',
            'target_path' => $this->generateUrl('index'),
            'remember_me_enabled' => true,
            'remember_me_checked' => true,
        ]);
    }
}
