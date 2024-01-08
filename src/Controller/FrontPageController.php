<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontPageController extends AbstractController
{
    #[Route('/welcome', name: 'app_frontpage')]
    public function index(): Response
    {
        return $this->render('pages/welcome/index.html.twig', [
            'controller_name' => 'FrontPageController',
        ]);
    }
}
