<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Update;
use App\Entity\Chassis;
use App\Entity\Speaker;
use App\Entity\Amplifier;
use App\Entity\Processor;
use App\Entity\Manufacturer;
use App\Entity\ValidationRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Symfony\Component\Security\Core\User\UserInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
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
        yield MenuItem::linkToCrud('Updates', 'fas fa-list', Update::class);
        yield MenuItem::section('App');
        yield MenuItem::linkToCrud('Manufacturers', 'fa-solid fa-industry', Manufacturer::class);
        yield MenuItem::linkToCrud('Processors', 'icon icon-processor', Processor::class);
        yield MenuItem::linkToCrud('Amplifiers', 'icon-amplifier', Amplifier::class);
        yield MenuItem::linkToCrud('Speaker', 'icon-speaker', Speaker::class);
        yield MenuItem::linkToCrud('Chassis', 'icon-chassis', Chassis::class);
        yield MenuItem::section('Validation');
        yield MenuItem::linkToCrud('Requests', 'fa-solid fa-circle-check', ValidationRequest::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)
            ->addMenuItems([
                MenuItem::linkToRoute('Back To System Designer', 'fa-solid fa-arrow-left', 'app_main'),
            ]);
    }
}
