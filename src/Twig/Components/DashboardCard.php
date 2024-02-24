<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class DashboardCard
{
    public string $title;
    public $items;
    public string $icon;
    public int $max_count = 10;
}
