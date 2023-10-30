<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatableMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SubscriptionController extends AbstractController
{
    #[Route('/app/subscription', name: 'app_subscription')]
    public function index(): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        return $this->render('pages/subscription/index.html.twig', [
            'controller_name' => 'SubscriptionController',
            'title' => new TranslatableMessage('Subscription'),
            'maxCount' => 10,
            'beta' => false,
        ]);
    }
}
