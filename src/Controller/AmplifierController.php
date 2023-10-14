<?php

namespace App\Controller;

use App\Entity\Amplifier;
use App\Form\AmplifierType;
use App\Repository\AmplifierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
        return $this->render('amplifier/index.html.twig', [
            'amplifiers' => $amplifierRepository->findAll(),
            'controller_name' => 'AmplifierController',
            'title' => 'Amplifier',
            'crud_title' => 'All Amplifiers',
        ]);
    }

    #[Route('/new', name: 'app_amplifier_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $amplifier = new Amplifier();
        $user = $this->getUser();
        $amplifier->setUser($user);

        $form = $this->createForm(AmplifierType::class, $amplifier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($amplifier);
            $entityManager->flush();

            return $this->redirectToRoute('app_amplifier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('amplifier/new.html.twig', [
            'amplifier' => $amplifier,
            'form' => $form,
            'controller_name' => 'AmplifierController',
            'title' => 'Amplifier',
            'crud_title' => 'New Amplifier',
        ]);
    }

    #[Route('/{id}', name: 'app_amplifier_show', methods: ['GET'])]
    public function show(Amplifier $amplifier): Response
    {
        return $this->render('amplifier/show.html.twig', [
            'amplifier' => $amplifier,
            'controller_name' => 'AmplifierController',
            'title' => 'Amplifier',
            'crud_title' => 'Show Amplifier',
        ]);
    }

    #[Route('/{id}/edit', name: 'app_amplifier_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Amplifier $amplifier, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AmplifierType::class, $amplifier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_amplifier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('amplifier/edit.html.twig', [
            'amplifier' => $amplifier,
            'form' => $form,
            'controller_name' => 'AmplifierController',
            'title' => 'Amplifier',
            'crud_title' => 'Edit Amplifier',
        ]);
    }

    #[Route('/{id}', name: 'app_amplifier_delete', methods: ['POST'])]
    public function delete(Request $request, Amplifier $amplifier, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$amplifier->getId(), $request->request->get('_token'))) {
            $entityManager->remove($amplifier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_amplifier_index', [], Response::HTTP_SEE_OTHER);
    }
}