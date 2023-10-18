<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Processor;
use App\Form\ProcessorType;
use App\Service\ManualUploader;
use App\Repository\ProcessorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Novaway\Bundle\FeatureFlagBundle\Annotation\Feature;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

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
            'crud_title' => 'All Processors',
        ]);
    }

    #[Route('/new', name: 'app_processor_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, ManualUploader $manualUploader): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        if (!($user->isSubscriber()) && ($user->getAmplifiers()->count() >= 10)) {
            return $this->render('subscription/limit.html.twig', [
                'title' => 'Limit Reached',
                'crud_title' => 'Limit Reached',
            ]);
        }

        $processor = new Processor();
        $processor->setUser($user);

        $form = $this->createForm(ProcessorType::class, $processor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if (!($user->isSubscriber()) && ($user->getAmplifiers()->count() >= 10)) {
                return $this->render('subscription/limit.html.twig', [
                    'title' => 'Limit Reached',
                    'crud_title' => 'Limit Reached',
                ]);
            }

            /** @var UploadedFile $manual */
            $manual = $form->get('Manual')->getData();

            $manufacturer = $form->get('Manufacturer')->getData();
            $name = $form->get('Name')->getData();

            if ($manual) {
                $manualName = $manualUploader->upload($manual, $manufacturer, $name);
                $processor->setManual($manualName);
            }
            
            $entityManager->persist($processor);
            $entityManager->flush();

            return $this->redirectToRoute('app_processor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('processor/new.html.twig', [
            'processor' => $processor,
            'form' => $form,
            'controller_name' => 'ProcessorController',
            'title' => 'Processor',
            'crud_title' => 'New Processor',
        ]);
    }

    #[Route('/{id}', name: 'app_processor_show', methods: ['GET'])]
    public function show(Processor $processor): Response
    {
        return $this->render('processor/show.html.twig', [
            'processor' => $processor,
            'controller_name' => 'ProcessorController',
            'title' => 'Processor',
            'crud_title' => 'View Processor',
        ]);
    }

    #[Route('/{id}/edit', name: 'app_processor_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Processor $processor, EntityManagerInterface $entityManager, ManualUploader $manualUploader): Response
    {     
        $form = $this->createForm(ProcessorType::class, $processor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $manual */
            $manual = $form->get('Manual')->getData();

            $manufacturer = $form->get('Manufacturer')->getData();
            $name = $form->get('Name')->getData();

            if ($manual) {
                $manualName = $manualUploader->upload($manual, $manufacturer, $name);
                $processor->setManual($manualName);
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_processor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('processor/edit.html.twig', [
            'processor' => $processor,
            'form' => $form,
            'controller_name' => 'ProcessorController',
            'title' => 'Processor',
            'crud_title' => 'Edit Processor',
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
