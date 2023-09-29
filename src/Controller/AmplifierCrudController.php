<?php

namespace App\Controller;

use App\Entity\Amplifier;
use App\Form\AmplifierType;
use App\Repository\AmplifierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/amplifier/crud')]
class AmplifierCrudController extends AbstractController
{
    #[Route('/', name: 'app_amplifier_crud_index', methods: ['GET'])]
    public function index(AmplifierRepository $amplifierRepository): Response
    {
        return $this->render('amplifier_crud/index.html.twig', [
            'amplifiers' => $amplifierRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_amplifier_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $amplifier = new Amplifier();
        $form = $this->createForm(AmplifierType::class, $amplifier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($amplifier);
            $entityManager->flush();

            return $this->redirectToRoute('app_amplifier_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('amplifier_crud/new.html.twig', [
            'amplifier' => $amplifier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_amplifier_crud_show', methods: ['GET'])]
    public function show(Amplifier $amplifier): Response
    {
        return $this->render('amplifier_crud/show.html.twig', [
            'amplifier' => $amplifier,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_amplifier_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Amplifier $amplifier, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AmplifierType::class, $amplifier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_amplifier_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('amplifier_crud/edit.html.twig', [
            'amplifier' => $amplifier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_amplifier_crud_delete', methods: ['POST'])]
    public function delete(Request $request, Amplifier $amplifier, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$amplifier->getId(), $request->request->get('_token'))) {
            $entityManager->remove($amplifier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_amplifier_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
