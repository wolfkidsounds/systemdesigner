<?php

namespace App\Controller\Admin;

use App\Entity\Chassis;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ChassisCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Chassis::class;
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
