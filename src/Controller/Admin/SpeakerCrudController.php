<?php

namespace App\Controller\Admin;

use App\Entity\Speaker;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SpeakerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Speaker::class;
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
