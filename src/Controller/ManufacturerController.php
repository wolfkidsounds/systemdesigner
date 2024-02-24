<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Setting;
use App\Entity\Manufacturer;
use App\Form\ManufacturerType;
use App\Entity\ValidationRequest;
use App\Form\ValidationRequestType;
use App\Repository\SettingRepository;
use App\Service\NotificationService;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ManufacturerRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatableMessage;
use Novaway\Bundle\FeatureFlagBundle\Annotation\Feature;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Feature(name: "manufacturers")]
#[IsGranted('ROLE_USER')]
#[Route('/app/manufacturer')]
class ManufacturerController extends AbstractController
{
    #[Route('/', name: 'app_manufacturer_index', methods: ['GET'])]
    public function index(ManufacturerRepository $manufacturerRepository, SettingRepository $settingRepository): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        if ($user->isSubscriber() && $user->isDatabaseAccessEnabled()) {
            $manufacturers = $manufacturerRepository->findByUserOrValidated($user);
        } else {
            $manufacturers = $manufacturerRepository->findBy(['User' => $user], [], 10);
        }

        return $this->render('pages/crud/manufacturer/index.html.twig', [
            'manufacturers' => $manufacturers,
            'title' => new TranslatableMessage('Manufacturer'),
            'crud_title' => new TranslatableMessage('All Manufacturers'),
            'maxCount' => 10,
            'tourButton' => true,
        ]);
        
    }

    #[Route('/new', name: 'app_manufacturer_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        if (!($user->isSubscriber()) && ($user->getManufacturers()->count() >= 10)) {
            return $this->render('pages/subscription/limit.html.twig', [
                'title' => new TranslatableMessage('Limit Reached'),
                'crud_title' => new TranslatableMessage('Limit Reached'),
            ]);
        }

        $manufacturer = new Manufacturer();
        $manufacturer->setUser($user);

        $form = $this->createForm(ManufacturerType::class, $manufacturer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if (!($user->isSubscriber()) && ($user->getManufacturers()->count() >= 10)) {
                return $this->render('pages/subscription/limit.html.twig', [
                    'title' => new TranslatableMessage('Limit Reached'),
                    'crud_title' => new TranslatableMessage('Limit Reached'),
                ]);
            }

            $entityManager->persist($manufacturer);
            $entityManager->flush();

            return $this->redirectToRoute('app_manufacturer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pages/crud/manufacturer/new.html.twig', [
            'manufacturer' => $manufacturer,
            'form' => $form,
            'title' => new TranslatableMessage('Manufacturer'),
            'crud_title' => new TranslatableMessage('New Manufacturer'),
            'reachedMaxCount' => false,
        ]);
    }

    #[Route('/show/{id}', name: 'app_manufacturer_show', methods: ['GET', 'POST'])]
    public function show(Manufacturer $manufacturer, Request $request, EntityManagerInterface $entityManager): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $validationRequest = new ValidationRequest();
        $validationRequest->setUser($user);
        $validationRequest->setManufacturer($manufacturer);

        $form = $this->createForm(ValidationRequestType::class, $validationRequest);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $validationRequest->setStatus('requested');
            $entityManager->persist($validationRequest);
            $entityManager->flush();
        }

        if ($manufacturer->getValidationRequests()->count() > 0) {
            $validationRequested = true;

        } else {
            $validationRequested = false;
        }

        return $this->render('pages/crud/manufacturer/show.html.twig', [
            'manufacturer' => $manufacturer,
            'form' => $form,
            'validationRequested' => $validationRequested,
            'title' => new TranslatableMessage('Manufacturer'),
            'crud_title' => new TranslatableMessage('View Manufacturer'),
        ]);
    }

    #[Route('/edit/{id}', name: 'app_manufacturer_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Manufacturer $manufacturer, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ManufacturerType::class, $manufacturer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_manufacturer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pages/crud/manufacturer/edit.html.twig', [
            'manufacturer' => $manufacturer,
            'form' => $form,
            'title' => new TranslatableMessage('Manufacturer'),
            'crud_title' => new TranslatableMessage('Edit Manufacturer'),
        ]);
    }

    #[Route('/delete/{id}', name: 'app_manufacturer_delete', methods: ['POST'])]
    public function delete(Request $request, Manufacturer $manufacturer, EntityManagerInterface $entityManager): Response
    {
        dump($request);
        dump($manufacturer);

        if ($this->isCsrfTokenValid('delete'.$manufacturer->getId(), $request->request->get('_token'))) {
            $entityManager->remove($manufacturer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_manufacturer_index', [], Response::HTTP_SEE_OTHER);
    }
}
