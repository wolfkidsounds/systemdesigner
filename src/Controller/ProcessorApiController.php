<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Novaway\Bundle\FeatureFlagBundle\Annotation\Feature;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Feature(name: "api")]
class ProcessorApiController extends AbstractController
{
    #[Route('/api/processor/{id<\d+>}', name: 'api_get_processor', methods:['GET'])]
    public function getProcessor(int $id): Response
    {
        // TODO query the database
        
        $processor = [
            'id' => $id,
            'brand' => 'Behringer',
            'name' => 'DCX 2496 Pro',
            'channels_input' => 3,
            'channels_output' => 6,
            'output_offset' => 22,
        ];

        return $this->json($processor);
    }
}
