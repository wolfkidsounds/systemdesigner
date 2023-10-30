<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Processor;
use App\Form\ProcessorType;
use App\Service\ManualUploader;
use App\Entity\ValidationRequest;
use App\Form\ValidationRequestType;
use App\Repository\ProcessorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Translation\TranslatableMessage;
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
        /** @var User $user */
        $user = $this->getUser();

        if ($user->isDatabaseAccessEnabled()) {
            $processors = $processorRepository->findByUserOrValidated($user);
        } else {
            $processors = $processorRepository->findBy(['User' => $user]);
        }

        return $this->render('pages/processor/index.html.twig', [
            'processors' => $processors,
            'controller_name' => 'ProcessorController',
            'title' => new TranslatableMessage('Processor'),
            'crud_title' => new TranslatableMessage('All Processors'),
        ]);
    }

    #[Route('/new', name: 'app_processor_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, ManualUploader $manualUploader): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        if (!($user->isSubscriber()) && ($user->getAmplifiers()->count() >= 10)) {
            return $this->render('subscription/limit.html.twig', [
                'title' => new TranslatableMessage('Limit Reached'),
                'crud_title' => new TranslatableMessage('Limit Reached'),
            ]);
        }

        $processor = new Processor();
        $processor->setUser($user);

        $form = $this->createForm(ProcessorType::class, $processor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if (!($user->isSubscriber()) && ($user->getAmplifiers()->count() >= 10)) {
                return $this->render('subscription/limit.html.twig', [
                    'title' => new TranslatableMessage('Limit Reached'),
                    'crud_title' => new TranslatableMessage('Limit Reached'),
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

        return $this->render('pages/processor/new.html.twig', [
            'processor' => $processor,
            'form' => $form,
            'controller_name' => 'ProcessorController',
            'title' => new TranslatableMessage('Processor'),
            'crud_title' => new TranslatableMessage('New Processor'),
        ]);
    }

    #[Route('/show/{id}', name: 'app_processor_show', methods: ['GET', 'POST'])]
    public function show(Processor $processor, Request $request, EntityManagerInterface $entityManager): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $validationRequest = new ValidationRequest();
        $validationRequest->setUser($user);
        $validationRequest->setProcessor($processor);

        $form = $this->createForm(ValidationRequestType::class, $validationRequest);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $validationRequest->setStatus('requested');
            $entityManager->persist($validationRequest);
            $entityManager->flush();
        }

        if ($processor->getValidationRequests()->count() > 0) {
            $validationRequested = true;

        } else {
            $validationRequested = false;
        }
        
        return $this->render('pages/processor/show.html.twig', [
            'processor' => $processor,
            'form' => $form,
            'validationRequested' => $validationRequested,
            'controller_name' => 'ProcessorController',
            'title' => new TranslatableMessage('Processor'),
            'crud_title' => new TranslatableMessage('View Processor'),
        ]);
    }

    #[Route('/edit/{id}', name: 'app_processor_edit', methods: ['GET', 'POST'])]
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

        return $this->render('pages/processor/edit.html.twig', [
            'processor' => $processor,
            'form' => $form,
            'controller_name' => 'ProcessorController',
            'title' => new TranslatableMessage('Processor'),
            'crud_title' => new TranslatableMessage('Edit Processor'),
        ]);
    }

    #[Route('/delete/{id}', name: 'app_processor_delete', methods: ['POST'])]
    public function delete(Request $request, Processor $processor, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$processor->getId(), $request->request->get('_token'))) {
            $entityManager->remove($processor);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_processor_index', [], Response::HTTP_SEE_OTHER);
    }
}
