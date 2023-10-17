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
        /** @var User $user */
        $user = $this->getUser();

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'title' => 'Dashboard',
            'isSubscriber' => $user->isSubscriber(),
            'amplifiersCount' => $user->getAmplifiers()->count(),
            'processorsCount' => $user->getProcessors()->count(),
            'speakersCount' => $user->getSpeakers()->count(),
            'manufacturersCount' => $user->getManufacturers()->count(),
            'limitersCount' => $user->getLimiters()->count(),
            'maxCount' => 10,
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
