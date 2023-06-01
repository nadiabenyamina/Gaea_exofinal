<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
    #[Route('/users', name: 'app_users')]
    public function users(): Response
    {
        return $this->render('users/users.html.twig', [
            'controller_name' => 'UsersController',
        ]);
    }

    #[Route('/possessions', name: 'app_possessions')]
    public function possessions(): Response
    {
        return $this->render('possessions/possessions.html.twig', [
            'controller_name' => 'UsersController',
        ]);
    }
}
