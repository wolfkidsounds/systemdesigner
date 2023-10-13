<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Setting;
use App\Entity\Manufacturer;
use App\Form\ManufacturerType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ManufacturerRepository;
use App\Repository\SettingRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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

        if (true) {

            return $this->render('manufacturer/index.html.twig', [
                'manufacturers' => $manufacturerRepository->findBy(['User' => $user]),
                'title' => 'Manufacturer',
                'crud_title' => 'All Manufacturers',
            ]);

        } else {

            return $this->render('manufacturer/index.html.twig', [
                'manufacturers' => $manufacturerRepository->findAll(),
                'title' => 'Manufacturer',
                'crud_title' => 'All Manufacturers',
            ]);
        }
        
    }

    #[Route('/new', name: 'app_manufacturer_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $manufacturer = new Manufacturer();
        $user = $this->getUser();
        $manufacturer->setUser($user);

        $form = $this->createForm(ManufacturerType::class, $manufacturer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($manufacturer);
            $entityManager->flush();

            return $this->redirectToRoute('app_manufacturer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('manufacturer/new.html.twig', [
            'manufacturer' => $manufacturer,
            'form' => $form,
            'title' => 'Manufacturer',
            'crud_title' => 'New Manufacturer',
        ]);
    }

    #[Route('/{id}', name: 'app_manufacturer_show', methods: ['GET'])]
    public function show(Manufacturer $manufacturer): Response
    {
        return $this->render('manufacturer/show.html.twig', [
            'manufacturer' => $manufacturer,
            'title' => 'Manufacturer',
            'crud_title' => 'View Manufacturer',
        ]);
    }

    #[Route('/{id}/edit', name: 'app_manufacturer_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Manufacturer $manufacturer, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ManufacturerType::class, $manufacturer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_manufacturer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('manufacturer/edit.html.twig', [
            'manufacturer' => $manufacturer,
            'form' => $form,
            'title' => 'Manufacturer',
            'crud_title' => 'Edit Manufacturer',
        ]);
    }

    #[Route('/{id}', name: 'app_manufacturer_delete', methods: ['POST'])]
    public function delete(Request $request, Manufacturer $manufacturer, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$manufacturer->getId(), $request->request->get('_token'))) {
            $entityManager->remove($manufacturer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_manufacturer_index', [], Response::HTTP_SEE_OTHER);
    }
}
