<?php // src/Menu/MenuBuilder.php

namespace App\Menu;

use Knp\Menu\ItemInterface;
use Knp\Menu\FactoryInterface;
use Novaway\Bundle\FeatureFlagBundle\Manager\DefaultFeatureManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MenuBuilder extends AbstractController
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
        $menu = $this->factory->createItem('sidebar');
        
        // Sidebar
        $menu->addChild('Sidebar', [
            'route' => 'app_main',
        ]);

        if ($this->featureManager->isEnabled('processor')) {
            $menu['Sidebar']->addChild('Processor', [
                'route' => 'app_processor_index',
                'extras' => [
                    'icon' => 'icon icon-processor',
                ]
            ]);
        }

        if ($this->featureManager->isEnabled('amplifier')) {
            $menu['Sidebar']->addChild('Amplifier', [
                'route' => 'app_main',
                'extras' => [
                    'icon' => 'icon icon-amplifier',
                ]
            ]);
        }

        if ($this->featureManager->isEnabled('speaker')) {
            $menu['Sidebar']->addChild('Speaker', [
                'route' => 'app_main',
                'extras' => [
                    'icon' => 'icon icon-speaker',
                ]
            ]);
        }

        if ($this->featureManager->isEnabled('chassis')) {
            $menu['Sidebar']->addChild('Chassis', [
                'route' => 'app_main',
                'extras' => [
                    'icon' => 'icon icon-chassis',
                ]
            ]);
        }

        return $menu;
    }
}