<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Chassis;
use App\Form\ChassisType;
use App\Repository\ChassisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatableMessage;
use Novaway\Bundle\FeatureFlagBundle\Annotation\Feature;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Feature(name: "chassis")]
#[IsGranted('ROLE_USER')]
#[Route('/app/chassis')]
class ChassisController extends AbstractController
{
    #[Route('/', name: 'app_chassis_index', methods: ['GET'])]
    public function index(ChassisRepository $chassisRepository): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        if ($user->isSubscriber() && $user->isDatabaseAccessEnabled()) {
            $chassis = $chassisRepository->findByUserOrValidated($user);
        } else {
            $chassis = $chassisRepository->findBy(['User' => $user], [], 10);
        }

        return $this->render('pages/crud/chassis/index.html.twig', [
            'chassis' => $chassis,
            'title' => new TranslatableMessage('Chassis'),
            'crud_title' => new TranslatableMessage('All Chassis'),
            'tourButton' => true,
        ]);
    }

    #[Route('/new', name: 'app_chassis_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $chassis = new Chassis();
        $form = $this->createForm(ChassisType::class, $chassis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $chassis->setUser($user);
            $chassis->setValidated(false);
            
            $entityManager->persist($chassis);
            $entityManager->flush();

            return $this->redirectToRoute('app_chassis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pages/crud/chassis/new.html.twig', [
            'chassis' => $chassis,
            'title' => new TranslatableMessage('Chassis'),
            'crud_title' => new TranslatableMessage('New Chassis'),
            'form' => $form,
            'tourButton' => true,
        ]);
    }

    #[Route('/show/{id}', name: 'app_chassis_show', methods: ['GET'])]
    public function show(Chassis $chassis): Response
    {
        return $this->render('pages/crud/chassis/show.html.twig', [
            'chassis' => $chassis,
        ]);
    }

    #[Route('/edit/{id}', name: 'app_chassis_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Chassis $chassis, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ChassisType::class, $chassis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_chassis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pages/crud/chassis/edit.html.twig', [
            'chassis' => $chassis,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'app_chassis_delete', methods: ['POST'])]
    public function delete(Request $request, Chassis $chassis, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$chassis->getId(), $request->request->get('_token'))) {
            $entityManager->remove($chassis);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_chassis_index', [], Response::HTTP_SEE_OTHER);
    }
}
