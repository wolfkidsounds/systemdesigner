<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Speaker;
use App\Form\SpeakerType;
use App\Service\ManualUploader;
use App\Entity\ValidationRequest;
use App\Form\ValidationRequestType;
use App\Repository\SpeakerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatableMessage;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/app/speaker')]
class SpeakerController extends AbstractController
{
    #[Route('/', name: 'app_speaker_index', methods: ['GET'])]
    public function index(SpeakerRepository $speakerRepository): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        if ($user->isDatabaseAccessEnabled()) {
            $speakers = $speakerRepository->findByUserOrValidated($user);
        } else {
            $speakers = $speakerRepository->findBy(['User' => $user]);
        }

        return $this->render('pages/speaker/index.html.twig', [
            'speakers' => $speakers,
            'title' => new TranslatableMessage('Speaker'),
            'crud_title' => new TranslatableMessage('All Speakers'),
            'tourButton' => true,
        ]);
    }

    #[Route('/new', name: 'app_speaker_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, ManualUploader $manualUploader): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        if (!($user->isSubscriber()) && ($user->getSpeakers()->count() >= 10)) {
            return $this->render('pages/subscription/limit.html.twig', [
                'title' => new TranslatableMessage('Limit Reached'),
                'crud_title' => new TranslatableMessage('Limit Reached'),
            ]);
        }

        $speaker = new Speaker();
        $speaker->setUser($user);

        $form = $this->createForm(SpeakerType::class, $speaker);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if (!($user->isSubscriber()) && ($user->getSpeakers()->count() >= 10)) {
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
                $speaker->setManual($manualName);
            }

            $entityManager->persist($speaker);
            $entityManager->flush();

            return $this->redirectToRoute('app_speaker_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pages/speaker/new.html.twig', [
            'speaker' => $speaker,
            'form' => $form,
            'title' => new TranslatableMessage('Speaker'),
            'crud_title' => new TranslatableMessage('New Speaker'),
            'tourButton' => true,
        ]);
    }

    #[Route('/show/{id}', name: 'app_speaker_show', methods: ['GET', 'POST'])]
    public function show(Speaker $speaker, Request $request, EntityManagerInterface $entityManager): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $validationRequest = new ValidationRequest();
        $validationRequest->setUser($user);
        $validationRequest->setSpeaker($speaker);

        $form = $this->createForm(ValidationRequestType::class, $validationRequest);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $validationRequest->setStatus('requested');
            $entityManager->persist($validationRequest);
            $entityManager->flush();
        }

        if ($speaker->getValidationRequests()->count() > 0) {
            $validationRequested = true;
        } else {
            $validationRequested = false;
        }
        
        return $this->render('pages/speaker/show.html.twig', [
            'speaker' => $speaker,
            'form' => $form,
            'validationRequested' => $validationRequested,
            'title' => new TranslatableMessage('Speaker'),
            'crud_title' => new TranslatableMessage('View Speaker'),
        ]);
    }

    #[Route('/edit/{id}', name: 'app_speaker_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Speaker $speaker, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SpeakerType::class, $speaker);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_speaker_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pages/speaker/edit.html.twig', [
            'speaker' => $speaker,
            'form' => $form,
            'title' => new TranslatableMessage('Speaker'),
            'crud_title' => new TranslatableMessage('Edit Speaker'),
        ]);
    }

    #[Route('/delete/{id}', name: 'app_speaker_delete', methods: ['POST'])]
    public function delete(Request $request, Speaker $speaker, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$speaker->getId(), $request->request->get('_token'))) {
            $entityManager->remove($speaker);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_speaker_index', [], Response::HTTP_SEE_OTHER);
    }
}
