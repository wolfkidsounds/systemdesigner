<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class CrudTable
{
    public array $fields;
    public bool $actions;
    public array $items;
    public string $path;

}
