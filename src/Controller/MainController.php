<?php

namespace App\Controller;

use App\Entity\User;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/app', name: 'app_main')]
    public function main(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        
        return $this->render('pages/main/index.html.twig', [
            'controller_name' => 'MainController',
            'title' => 'Dashboard',
            'maxCount' => 10,
            'tourButton' => true,
        ]);
    }

    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_frontpage');
        } else {
            return $this->redirectToRoute('app_main');
        }
    }
}
