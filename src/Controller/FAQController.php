<?php

namespace App\Controller;

use App\Repository\FAQRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatableMessage;

class FAQController extends AbstractController
{
    #[Route('/app/faq', name: 'app_faq')]
    public function index(FAQRepository $faqRepository): Response
    {
        $faqs = $faqRepository->findAll();

        $groupedFaqs = [];

        foreach ($faqs as $faq) {
            $category = $faq->getCategory();

            if (!isset($groupedFaqs[$category])) {
                $groupedFaqs[$category] = [
                    'category' => $category,
                    'contents' => [],
                ];
            }

            $groupedFaqs[$category]['contents'][] = [
                'name' => $faq->getName(),
                'description' => $faq->getDescription(),
            ];
        }

        return $this->render('pages/faq/index.html.twig', [
            'faqs' => $groupedFaqs,
            'controller_name' => 'FAQController',
            'title' => new TranslatableMessage('Frequently Asked Questions'),
        ]);
    }
}
