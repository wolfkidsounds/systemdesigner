<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Speaker;
use App\Form\SpeakerType;
use App\Service\ManualUploader;
use App\Repository\SpeakerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/app/speaker')]
class SpeakerController extends AbstractController
{
    #[Route('/', name: 'app_speaker_index', methods: ['GET'])]
    public function index(SpeakerRepository $speakerRepository): Response
    {
        return $this->render('speaker/index.html.twig', [
            'speakers' => $speakerRepository->findAll(),
            'title' => 'Speaker',
            'crud_title' => 'All Speakers',
        ]);
    }

    #[Route('/new', name: 'app_speaker_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, ManualUploader $manualUploader): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        if (!($user->isSubscriber()) && ($user->getAmplifiers()->count() >= 10)) {
            return $this->render('subscription/limit.html.twig', [
                'title' => 'Limit Reached',
                'crud_title' => 'Limit Reached',
            ]);
        }

        $speaker = new Speaker();
        $speaker->setUser($user);

        $form = $this->createForm(SpeakerType::class, $speaker);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if (!($user->isSubscriber()) && ($user->getAmplifiers()->count() >= 10)) {
                return $this->render('subscription/limit.html.twig', [
                    'title' => 'Limit Reached',
                    'crud_title' => 'Limit Reached',
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

        return $this->render('speaker/new.html.twig', [
            'speaker' => $speaker,
            'form' => $form,
            'title' => 'Speaker',
            'crud_title' => 'New Speaker',
        ]);
    }

    #[Route('/{id}', name: 'app_speaker_show', methods: ['GET'])]
    public function show(Speaker $speaker): Response
    {
        return $this->render('speaker/show.html.twig', [
            'speaker' => $speaker,
            'title' => 'Speaker',
            'crud_title' => 'View Speaker',
        ]);
    }

    #[Route('/{id}/edit', name: 'app_speaker_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Speaker $speaker, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SpeakerType::class, $speaker);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_speaker_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('speaker/edit.html.twig', [
            'speaker' => $speaker,
            'form' => $form,
            'title' => 'Speaker',
            'crud_title' => 'Edit Speaker',
        ]);
    }

    #[Route('/{id}', name: 'app_speaker_delete', methods: ['POST'])]
    public function delete(Request $request, Speaker $speaker, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$speaker->getId(), $request->request->get('_token'))) {
            $entityManager->remove($speaker);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_speaker_index', [], Response::HTTP_SEE_OTHER);
    }
}
