<?php

namespace App\Controller\Admin;

use App\Entity\Update;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UpdateCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Update::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('Name');
        yield DateField::new('Date');
        yield TextEditorField::new('Description');
    }
}
