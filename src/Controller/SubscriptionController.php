<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SubscriptionController extends AbstractController
{
    #[Route('/app/subscription', name: 'app_subscription')]
    public function index(): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        return $this->render('subscription/index.html.twig', [
            'controller_name' => 'SubscriptionController',
            'title' => 'Subscription',
            'isSubscriber' => $user->isSubscriber(),
            'amplifiersCount' => $user->getAmplifiers()->count(),
            'processorsCount' => $user->getProcessors()->count(),
            'speakersCount' => $user->getSpeakers()->count(),
            'manufacturersCount' => $user->getManufacturers()->count(),
            'limitersCount' => $user->getLimiters()->count(),
            'maxCount' => 10,
            'beta' => false,
        ]);
    }
}
