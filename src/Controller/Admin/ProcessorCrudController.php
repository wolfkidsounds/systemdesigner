<?php

namespace App\Controller\Admin;

use App\Entity\Processor;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class ProcessorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Processor::class;
    }

    public function configureFields(string $pageName): Iterable
    {
        return [
            IdField::new('id'),
        ];

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
