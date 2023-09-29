<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProcessorController extends AbstractController
{
    #[Route('/processor', name: 'app_processor')]
    public function index(): Response
    {
        return $this->render('processor/index.html.twig', [
            'controller_name' => 'ProcessorController',
        ]);
    }
}
