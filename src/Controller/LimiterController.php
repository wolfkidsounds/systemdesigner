<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LimiterController extends AbstractController
{
    #[Route('/limiter', name: 'app_limiter')]
    public function index(): Response
    {
        return $this->render('limiter/index.html.twig', [
            'controller_name' => 'LimiterController',
        ]);
    }
}
