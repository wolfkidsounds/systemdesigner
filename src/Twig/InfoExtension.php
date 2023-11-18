<?php // src/Twig/InfoExtension.php
namespace App\Twig;

use Twig\TwigFunction;
use App\Service\InfoService;
use Twig\Extension\AbstractExtension;

class InfoExtension extends AbstractExtension
{
    private $InfoService;

    public function __construct(InfoService $InfoService)
    {
        $this->InfoService = $InfoService;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('infoButton', [$this, 'infoButton'], ['is_safe' => ['html']]),
        ];
    }

    public function infoButton(string $infoText)
    {
        return $this->InfoService->generateInfoButton($infoText);
    }
}
