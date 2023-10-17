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
            'subscriber_status' => $user->isSubscriber(),
            'verification_status' => $user->isVerified(),
            'amplifier_count' => $user->getAmplifiers()->count(),
            'processor_count' => $user->getProcessors()->count(),
            'speaker_count' => $user->getSpeakers()->count(),
            'manufacturer_count' => $user->getManufacturers()->count(),
            'limiter_count' => $user->getLimiters()->count(),
            'count_limit' => 10,
        ]);
    }
}
