<?php // src/Twig/InfoExtension.php
namespace App\Twig;

use App\Service\InfoGenerator;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class InfoExtension extends AbstractExtension
{
    private $infoGenerator;

    public function __construct(InfoGenerator $infoGenerator)
    {
        $this->infoGenerator = $infoGenerator;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('infoButton', [$this, 'infoButton'], ['is_safe' => ['html']]),
        ];
    }

    public function infoButton(string $infoText)
    {
        return $this->infoGenerator->generateInfoButton($infoText);
    }
}
