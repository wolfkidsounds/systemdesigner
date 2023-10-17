<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Amplifier;
use App\Entity\Processor;
use App\Entity\Manufacturer;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Novaway\Bundle\FeatureFlagBundle\Annotation\Feature;

#[Feature(name: "admin")]
#[IsGranted('ROLE_ADMIN')]
class DashboardController extends AbstractDashboardController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('System Designer');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('Users');
        yield MenuItem::linkToCrud('Users', 'fa fa-user', User::class);
        yield MenuItem::section('App');
        yield MenuItem::linkToCrud('Processors', 'icon icon-processor', Processor::class);
        yield MenuItem::linkToCrud('Amplifiers', 'icon-amplifier', Amplifier::class);
        yield MenuItem::linkToCrud('Speaker', 'icon-speaker', Speaker::class);
        //yield MenuItem::linkToCrud('Chassis', 'icon-chassis', Chassis::class);
        yield MenuItem::section('Extra');
        yield MenuItem::linkToCrud('Manufacturers', 'fa-solid fa-industry', Manufacturer::class);
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)
            ->addMenuItems([
                MenuItem::linkToRoute('Back To System Designer', 'fa-solid fa-arrow-left', 'app_main'),
            ]);
    }

    public function configureAssets(): Assets
    {
        return parent::configureAssets()
            ->addWebpackEncoreEntry('admin')
        ;
    }
}