<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class CrudToolbar
{
    public bool $add;
    public bool $back;
    public string $path;
}