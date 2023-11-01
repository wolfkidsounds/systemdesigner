<?php

namespace App\Controller\Admin;

use App\Entity\ValidationRequest;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ValidationRequestCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ValidationRequest::class;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('User'),
            TextField::new('Object'),
            ChoiceField::new('Status')
                ->autocomplete()
                ->renderAsBadges([
                    'requested' => 'warning',
                    'validated' => 'success',
                    'rejected' => 'danger',
                ])
                ->setChoices([
                    'Requested' => 'requested',
                    'Validated' => 'validated',
                    'Rejected' => 'rejected',
                ]
            ),
            TextareaField::new('Message'),
        ];
        
    }
}
