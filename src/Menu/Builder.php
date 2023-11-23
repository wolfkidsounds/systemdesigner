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

        $menu->addChild('Dashboard', [
            'route' => 'app_main',
            'extras' => [
                'icon' => 'icon icon-chassis text-primary',
            ],
        ]);

        if ($this->isGranted('ROLE_ADMIN') && $this->featureManager->isEnabled('admin')) {
            $menu->addChild('Admin', [
                'route' => 'admin',
                'extras' => [
                    'icon' => 'fa-solid fa-dashboard',
                ]
            ]);

            $menu->addChild('divider_1', [
                'divider' => true,
                'extras' => [
                    'divider' => true,
                ]
            ]);
        }

        if ($this->featureManager->isEnabled('manufacturers')) {
            $menu->addChild('Manufacturer', [
                'route' => 'app_manufacturer_index',
                'extras' => [
                    'icon' => 'fa-solid fa-industry',
                ]
            ]);
        }
        
        if ($this->featureManager->isEnabled('processor')) {
            $menu->addChild('Processor', [
                'route' => 'app_processor_index',
                'extras' => [
                    'icon' => 'icon icon-processor',
                ]
            ]);
        }

        if ($this->featureManager->isEnabled('amplifier')) {
            $menu->addChild('Amplifier', [
                'route' => 'app_amplifier_index',
                'extras' => [
                    'icon' => 'icon icon-amplifier',
                ]
            ]);
        }

        if ($this->featureManager->isEnabled('speaker')) {
            $menu->addChild('Speaker', [
                'route' => 'app_speaker_index',
                'extras' => [
                    'icon' => 'icon icon-speaker',
                ]
            ]);
        }

        if ($this->featureManager->isEnabled('chassis') && $user->isSubscriber()) {
            $menu->addChild('Chassis', [
                'route' => 'app_chassis_index',
                'extras' => [
                    'icon' => 'icon icon-chassis',
                ]
            ]);
        }

        if ($this->featureManager->isEnabled('limiter')) {
            $menu->addChild('divider_2', [
                'divider' => true,
                'extras' => [
                    'divider' => true,
                ]
            ]);

            $menu->addChild('Limiter', [
                'route' => 'app_limiter_index',
                'extras' => [
                    'icon' => 'fa-solid fa-wave-square',
                ]
            ]);
        }

        return $menu;
    }
}