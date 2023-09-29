<?php

namespace App\Controller;

use App\Entity\Speaker;
use App\Form\SpeakerType;
use App\Repository\SpeakerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/speaker/crud')]
class SpeakerCrudController extends AbstractController
{
    #[Route('/', name: 'app_speaker_crud_index', methods: ['GET'])]
    public function index(SpeakerRepository $speakerRepository): Response
    {
        return $this->render('speaker_crud/index.html.twig', [
            'speakers' => $speakerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_speaker_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $speaker = new Speaker();
        $form = $this->createForm(SpeakerType::class, $speaker);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($speaker);
            $entityManager->flush();

            return $this->redirectToRoute('app_speaker_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('speaker_crud/new.html.twig', [
            'speaker' => $speaker,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_speaker_crud_show', methods: ['GET'])]
    public function show(Speaker $speaker): Response
    {
        return $this->render('speaker_crud/show.html.twig', [
            'speaker' => $speaker,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_speaker_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Speaker $speaker, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SpeakerType::class, $speaker);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_speaker_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('speaker_crud/edit.html.twig', [
            'speaker' => $speaker,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_speaker_crud_delete', methods: ['POST'])]
    public function delete(Request $request, Speaker $speaker, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$speaker->getId(), $request->request->get('_token'))) {
            $entityManager->remove($speaker);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_speaker_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
