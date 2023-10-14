<?php

namespace App\Controller;

use App\Entity\User;
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
        $user = $this->getUser();

        /** @var User $user */
        $processor_count = $user->getProcessors()->count();
        $amplifier_count = $user->getAmplifiers()->count();
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'title' => 'Dashboard',
            'amplifiers' => $amplifier_count,
            'processors' => $processor_count,
            'speakers' => 1,
        ]);
    }

    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        } else {
            return $this->redirectToRoute('app_main');
        }
    }
}
