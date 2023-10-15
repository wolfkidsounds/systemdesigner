<?php

namespace App\Controller;

use App\Entity\Limiter;
use App\Form\LimiterType;
use App\Repository\LimiterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/limiter')]
class LimiterController extends AbstractController
{
    #[Route('/', name: 'app_limiter_index', methods: ['GET'])]
    public function index(LimiterRepository $limiterRepository): Response
    {
        return $this->render('limiter/index.html.twig', [
            'limiters' => $limiterRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_limiter_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $limiter = new Limiter();
        $form = $this->createForm(LimiterType::class, $limiter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($limiter);
            $entityManager->flush();

            return $this->redirectToRoute('app_limiter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('limiter/new.html.twig', [
            'limiter' => $limiter,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_limiter_show', methods: ['GET'])]
    public function show(Limiter $limiter): Response
    {
        return $this->render('limiter/show.html.twig', [
            'limiter' => $limiter,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_limiter_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Limiter $limiter, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LimiterType::class, $limiter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_limiter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('limiter/edit.html.twig', [
            'limiter' => $limiter,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_limiter_delete', methods: ['POST'])]
    public function delete(Request $request, Limiter $limiter, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$limiter->getId(), $request->request->get('_token'))) {
            $entityManager->remove($limiter);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_limiter_index', [], Response::HTTP_SEE_OTHER);
    }
}