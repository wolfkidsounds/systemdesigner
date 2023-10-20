<?php // src/Service/MessageGenerator.php
namespace App\Service;

class InfoGenerator
{
    public function generateInfoButton(string $message): string
    {

        return <<<HTML
        <span class="info-button" aria-label="$message" data-balloon-length="xlarge" data-balloon-pos="right">
            <i class="fas fa-info-circle"></i>
        </span>
        HTML;
    }
}