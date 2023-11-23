<?php

namespace App\Controller;

use App\Repository\UpdateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatableMessage;

class UpdateController extends AbstractController
{
    #[Route('/app/updates', name: 'app_updates')]
    public function index(UpdateRepository $updateRepository): Response
    {
        $updates = $updateRepository->findAll();

        $groupedUpdates = [];

        foreach ($updates as $update) {
            $date = $update->getDate()->format('Y-m-d');

            if (!isset($groupedUpdates[$date])) {
                $groupedUpdates[$date] = [
                    'date' => $date,
                    'contents' => [],
                ];
            }

            $groupedUpdates[$date]['contents'][] = [
                'name' => $update->getName(),
                'description' => $update->getDescription(),
            ];
        }

        return $this->render('pages/update/index.html.twig', [
            'updates' => $groupedUpdates,
            'controller_name' => 'UpdateController',
            'title' => new TranslatableMessage('Updates'),
        ]);
    }
}
