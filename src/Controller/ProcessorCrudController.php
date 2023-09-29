<?php

namespace App\Controller;

use App\Entity\Processor;
use App\Form\ProcessorType;
use App\Repository\ProcessorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/processor/crud')]
class ProcessorCrudController extends AbstractController
{
    #[Route('/', name: 'app_processor_crud_index', methods: ['GET'])]
    public function index(ProcessorRepository $processorRepository): Response
    {
        return $this->render('processor_crud/index.html.twig', [
            'processors' => $processorRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_processor_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $processor = new Processor();
        $form = $this->createForm(ProcessorType::class, $processor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($processor);
            $entityManager->flush();

            return $this->redirectToRoute('app_processor_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('processor_crud/new.html.twig', [
            'processor' => $processor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_processor_crud_show', methods: ['GET'])]
    public function show(Processor $processor): Response
    {
        return $this->render('processor_crud/show.html.twig', [
            'processor' => $processor,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_processor_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Processor $processor, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProcessorType::class, $processor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_processor_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('processor_crud/edit.html.twig', [
            'processor' => $processor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_processor_crud_delete', methods: ['POST'])]
    public function delete(Request $request, Processor $processor, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$processor->getId(), $request->request->get('_token'))) {
            $entityManager->remove($processor);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_processor_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
