<?php

namespace App\Controller;

use App\Entity\Processor;
use App\Form\ProcessorType;
use App\Repository\ProcessorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Novaway\Bundle\FeatureFlagBundle\Annotation\Feature;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Feature(name: "processor")]
#[IsGranted('ROLE_USER')]
#[Route('/app/processor')]
class ProcessorController extends AbstractController
{
    #[Route('/', name: 'app_processor_index', methods: ['GET'])]
    public function index(ProcessorRepository $processorRepository): Response
    {
        return $this->render('processor/index.html.twig', [
            'processors' => $processorRepository->findAll(),
            'controller_name' => 'ProcessorController',
            'title' => 'Processor',
            'iconclass' => 'icon-processor',
        ]);
    }

    #[Route('/new', name: 'app_processor_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $processor = new Processor();
        $form = $this->createForm(ProcessorType::class, $processor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($processor);
            $entityManager->flush();

            return $this->redirectToRoute('app_processor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('processor/new.html.twig', [
            'processor' => $processor,
            'form' => $form,
            'controller_name' => 'ProcessorController',
            'title' => 'Processor',
            'iconclass' => 'icon-processor',
        ]);
    }

    #[Route('/{id}', name: 'app_processor_show', methods: ['GET'])]
    public function show(Processor $processor): Response
    {
        return $this->render('processor/show.html.twig', [
            'processor' => $processor,
            'controller_name' => 'ProcessorController',
            'title' => 'Processor',
            'iconclass' => 'icon-processor',
        ]);
    }

    #[Route('/edit/{id}', name: 'app_processor_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Processor $processor, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProcessorType::class, $processor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_processor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('processor/edit.html.twig', [
            'processor' => $processor,
            'form' => $form,
            'controller_name' => 'ProcessorController',
            'title' => 'Processor',
            'iconclass' => 'icon-processor',
        ]);
    }

    #[Route('/{id}', name: 'app_processor_delete', methods: ['POST'])]
    public function delete(Request $request, Processor $processor, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$processor->getId(), $request->request->get('_token'))) {
            $entityManager->remove($processor);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_processor_index', [], Response::HTTP_SEE_OTHER);
    }
}
