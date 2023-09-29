<?php

namespace App\Controller\Admin;

use App\Entity\Limiter;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class LimiterCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Limiter::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
