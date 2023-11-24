<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\SettingsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatableMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SettingsController extends AbstractController
{
    #[Route('/app/settings', name: 'app_settings')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $form = $this->createForm(SettingsType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // LOCALE
            $locale = $form->get('Locale')->getData();

            if ($locale) {
                $user->setLocale($locale);
                $request->setLocale($locale);
                $request->getSession()->set('_locale', $locale);
            }
            
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_settings', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pages/settings/index.html.twig', [
            'controller_name' => 'SettingsController',
            'form' => $form,
            'title' => new TranslatableMessage('Settings'),
        ]);
    }
}
