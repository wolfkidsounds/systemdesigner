<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Limiter;
use App\Form\LimiterType;
use App\Repository\LimiterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatableMessage;
use Novaway\Bundle\FeatureFlagBundle\Annotation\Feature;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Feature(name: "limiter")]
#[IsGranted('ROLE_USER')]
#[Route('/app/limiter')]
class LimiterController extends AbstractController
{
    #[Route('/', name: 'app_limiter_index', methods: ['GET'])]
    public function index(LimiterRepository $limiterRepository): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        return $this->render('pages/limiter/index.html.twig', [
            'limiters' => $limiterRepository->findBy(['User'=> $user]),
            'title' => new TranslatableMessage('Limiter'),
            'crud_title' => new TranslatableMessage('All Limiters'),
        ]);
    }

    #[Route('/new', name: 'app_limiter_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        if (!($user->isSubscriber()) && ($user->getAmplifiers()->count() >= 10)) {
            return $this->render('subscription/limit.html.twig', [
                'title' => new TranslatableMessage('Limit Reached'),
                'crud_title' => new TranslatableMessage('Limit Reached'),
            ]);
        }

        $limiter = new Limiter();
        $limiter->setUser($user);

        $form = $this->createForm(LimiterType::class, $limiter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if (!($user->isSubscriber()) && ($user->getAmplifiers()->count() >= 10)) {
                return $this->render('subscription/limit.html.twig', [
                    'title' => new TranslatableMessage('Limit Reached'),
                    'crud_title' => new TranslatableMessage('Limit Reached'),
                ]);
            }
            
            $entityManager->persist($limiter);
            $entityManager->flush();
            
            return $this->redirectToRoute('app_limiter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pages/limiter/new.html.twig', [
            'limiter' => $limiter,
            'form' => $form,
            'title' => new TranslatableMessage('Limiter'),
            'crud_title' => new TranslatableMessage('New Limiter'),
        ]);
    }

    #[Route('/show/{id}', name: 'app_limiter_show', methods: ['GET'])]
    public function show(Limiter $limiter): Response
    {
        return $this->render('pages/limiter/show.html.twig', [
            'limiter' => $limiter,
            'title' => new TranslatableMessage('Limiter'),
            'crud_title' => new TranslatableMessage('Show Limiter'),
        ]);
    }

    #[Route('/edit/{id}', name: 'app_limiter_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Limiter $limiter, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LimiterType::class, $limiter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_limiter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pages/limiter/edit.html.twig', [
            'limiter' => $limiter,
            'form' => $form,
            'title' => new TranslatableMessage('Limiter'),
            'crud_title' => new TranslatableMessage('Edit Limiter'),
        ]);
    }

    #[Route('/delete/{id}', name: 'app_limiter_delete', methods: ['POST'])]
    public function delete(Request $request, Limiter $limiter, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$limiter->getId(), $request->request->get('_token'))) {
            $entityManager->remove($limiter);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_limiter_index', [], Response::HTTP_SEE_OTHER);
    }
}
