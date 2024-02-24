<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DownloadController extends AbstractController
{
    #[Route('/download/{slug}', name: 'app_download')]
    public function index(string $slug): Response
    {
        $response = new BinaryFileResponse('uploads/manuals/' . $slug);
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $slug);
        return $response;
    }
}