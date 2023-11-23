<?php // src/Menu/Builder.php

namespace App\Menu;

use App\Entity\User;
use Knp\Menu\ItemInterface;
use Knp\Menu\FactoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Novaway\Bundle\FeatureFlagBundle\Manager\DefaultFeatureManager;

class Builder extends AbstractController
{
    private $factory;
    private DefaultFeatureManager $featureManager;

    /**
     * Add any other dependency you need...
     */
    public function __construct(FactoryInterface $factory, DefaultFeatureManager $featureManager)
    {
        $this->factory = $factory;
        $this->featureManager = $featureManager;
    }

    public function main(): ItemInterface
    {
        /** @var User $user */
        $user = $this->getUser();

        $menu = $this->factory->createItem('sidebar');

        $menu
            ->addChild('Dashboard', [
                'route' => 'app_main',
                'extras' => [
                    'icon' => 'icon icon-chassis text-primary',
                ],
            ])
            ->setAttributes(
                ['class' => 'nav-item d-lg-none']
            )
        ;

        if ($this->isGranted('ROLE_ADMIN') && $this->featureManager->isEnabled('admin')) {
            $menu
            ->addChild('Admin', [
                'route' => 'admin',
                'extras' => [
                    'icon' => 'fa-solid fa-dashboard',
                ]
            ])
            ->setAttributes(
                ['class' => 'nav-item']
            );

            $menu->addChild('divider_1', [
                'divider' => true,
                'extras' => [
                    'divider' => true,
                ]
            ]);
        }

        if ($this->featureManager->isEnabled('manufacturers')) {
            $menu
            ->addChild('Manufacturer', [
                'route' => 'app_manufacturer_index',
                'extras' => [
                    'icon' => 'fa-solid fa-industry',
                ]
            ])
            ->setAttributes(
                ['class' => 'nav-item']
            );
        }
        
        if ($this->featureManager->isEnabled('processor')) {
            $menu
            ->addChild('Processor', [
                'route' => 'app_processor_index',
                'extras' => [
                    'icon' => 'icon icon-processor',
                ]
            ])
            ->setAttributes(
                ['class' => 'nav-item']
            );
        }

        if ($this->featureManager->isEnabled('amplifier')) {
            $menu
            ->addChild('Amplifier', [
                'route' => 'app_amplifier_index',
                'extras' => [
                    'icon' => 'icon icon-amplifier',
                ]
            ])
            ->setAttributes(
                ['class' => 'nav-item']
            );
        }

        if ($this->featureManager->isEnabled('speaker')) {
            $menu
            ->addChild('Speaker', [
                'route' => 'app_speaker_index',
                'extras' => [
                    'icon' => 'icon icon-speaker',
                ]
            ])
            ->setAttributes(
                ['class' => 'nav-item']
            );
        }

        if ($this->featureManager->isEnabled('chassis') && $user->isSubscriber()) {
            $menu
            ->addChild('Chassis', [
                'route' => 'app_chassis_index',
                'extras' => [
                    'icon' => 'icon icon-chassis',
                ]
            ])
            ->setAttributes(
                ['class' => 'nav-item']
            );
        }

        if ($this->featureManager->isEnabled('limiter')) {
            $menu->addChild('divider_2', [
                'divider' => true,
                'extras' => [
                    'divider' => true,
                ]
            ]);

            $menu
            ->addChild('Limiter', [
                'route' => 'app_limiter_index',
                'extras' => [
                    'icon' => 'fa-solid fa-wave-square',
                ]
            ])
            ->setAttributes(
                ['class' => 'nav-item']
            );
        }

        return $menu;
    }
}