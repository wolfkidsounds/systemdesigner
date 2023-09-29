<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AmplifierController extends AbstractController
{
    #[Route('/amplifier', name: 'app_amplifier')]
    public function index(): Response
    {
        return $this->render('amplifier/index.html.twig', [
            'controller_name' => 'AmplifierController',
        ]);
    }
}
