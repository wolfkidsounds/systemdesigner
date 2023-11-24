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
    public function main(LoggerInterface $logger): Response
    {
        $logger->info('User was found.');
        $logger->info('Render Page');

        return $this->render('pages/main/index.html.twig', [
            'controller_name' => 'MainController',
            'title' => 'Dashboard',
            'maxCount' => 10,
            'tourButton' => true,
        ]);
    }

    #[Route('/', name: 'app_index')]
    public function index(LoggerInterface $logger): Response
    {
        $logger->info('Found Route /');
        if (!$this->getUser()) {
            $logger->info('Redirect to app_login');
            return $this->redirectToRoute('app_login');
        } else {
            $logger->info('Redirect to app_main');
            return $this->redirectToRoute('app_main');
        }
    }
}
