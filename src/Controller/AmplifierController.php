<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Amplifier;
use App\Form\AmplifierType;
use App\Service\ManualUploader;
use App\Entity\ValidationRequest;
use App\Form\ValidationRequestType;
use App\Repository\AmplifierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatableMessage;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Novaway\Bundle\FeatureFlagBundle\Annotation\Feature;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Feature(name: "processor")]
#[IsGranted('ROLE_USER')]
#[Route('/app/amplifier')]
class AmplifierController extends AbstractController
{
    #[Route('/', name: 'app_amplifier_index', methods: ['GET'])]
    public function index(AmplifierRepository $amplifierRepository): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        if ($user->isSubscriber() && $user->isDatabaseAccessEnabled()) {
            $amplifiers = $amplifierRepository->findByUserOrValidated($user);
        } else {
            $amplifiers = $amplifierRepository->findBy(['User' => $user], [], 10);
        }

        return $this->render('pages/amplifier/index.html.twig', [
            'amplifiers' => $amplifiers,
            'controller_name' => 'AmplifierController',
            'title' => new TranslatableMessage('Amplifier'),
            'crud_title' => new TranslatableMessage('All Amplifiers'),
            'tourButton' => true,
        ]);
    }

    #[Route('/new', name: 'app_amplifier_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, ManualUploader $manualUploader): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        if (!($user->isSubscriber()) && ($user->getAmplifiers()->count() >= 10)) {
            return $this->render('pages/subscription/limit.html.twig', [
                'title' => new TranslatableMessage('Limit Reached'),
                'crud_title' => new TranslatableMessage('Limit Reached'),
            ]);
        }

        $amplifier = new Amplifier();
        $amplifier->setUser($user);

        $form = $this->createForm(AmplifierType::class, $amplifier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if (!($user->isSubscriber()) && ($user->getAmplifiers()->count() >= 10)) {
                return $this->render('pages/subscription/limit.html.twig', [
                    'title' => new TranslatableMessage('Limit Reached'),
                    'crud_title' => new TranslatableMessage('Limit Reached'),
                ]);
            }

            /** @var UploadedFile $manual */
            $manual = $form->get('Manual')->getData();

            $manufacturer = $form->get('Manufacturer')->getData();
            $name = $form->get('Name')->getData();

            if ($manual) {
                $manualName = $manualUploader->upload($manual, $manufacturer, $name);
                $amplifier->setManual($manualName);
            }

            $entityManager->persist($amplifier);
            $entityManager->flush();

            return $this->redirectToRoute('app_amplifier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pages/amplifier/new.html.twig', [
            'amplifier' => $amplifier,
            'form' => $form,
            'controller_name' => 'AmplifierController',
            'title' => new TranslatableMessage('Amplifier'),
            'crud_title' => new TranslatableMessage('New Amplifier'),
            'tourButton' => true,
        ]);
    }

    #[Route('/show/{id}', name: 'app_amplifier_show', methods: ['GET', 'POST'])]
    public function show(Amplifier $amplifier, Request $request, EntityManagerInterface $entityManager): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $validationRequest = new ValidationRequest();
        $validationRequest->setUser($user);
        $validationRequest->setAmplifier($amplifier);

        $form = $this->createForm(ValidationRequestType::class, $validationRequest);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $validationRequest->setStatus('requested');
            $entityManager->persist($validationRequest);
            $entityManager->flush();
        }

        if ($amplifier->getValidationRequests()->count() > 0) {
            $validationRequested = true;
        } else {
            $validationRequested = false;
        }
        
        return $this->render('pages/amplifier/show.html.twig', [
            'amplifier' => $amplifier,
            'form' => $form,
            'validationRequested' => $validationRequested,
            'controller_name' => 'AmplifierController',
            'title' => new TranslatableMessage('Amplifier'),
            'crud_title' => new TranslatableMessage('Show Amplifier'),
        ]);
    }

    #[Route('/edit/{id}', name: 'app_amplifier_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Amplifier $amplifier, EntityManagerInterface $entityManager, ManualUploader $manualUploader): Response
    {
        $form = $this->createForm(AmplifierType::class, $amplifier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $manual */
            $manual = $form->get('Manual')->getData();

            $manufacturer = $form->get('Manufacturer')->getData();
            $name = $form->get('Name')->getData();

            if ($manual) {
                $manualName = $manualUploader->upload($manual, $manufacturer, $name);
                $amplifier->setManual($manualName);
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_amplifier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pages/amplifier/edit.html.twig', [
            'amplifier' => $amplifier,
            'form' => $form,
            'controller_name' => 'AmplifierController',
            'title' => new TranslatableMessage('Amplifier'),
            'crud_title' => new TranslatableMessage('Edit Amplifier'),
        ]);
    }

    #[Route('/delete/{id}', name: 'app_amplifier_delete', methods: ['POST'])]
    public function delete(Request $request, Amplifier $amplifier, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$amplifier->getId(), $request->request->get('_token'))) {
            $entityManager->remove($amplifier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_amplifier_index', [], Response::HTTP_SEE_OTHER);
    }
}
