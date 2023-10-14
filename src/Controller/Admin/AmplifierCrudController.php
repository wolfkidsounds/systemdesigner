<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Amplifier;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AmplifierCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Amplifier::class;
    }

    public function configureFields(string $amplifier): iterable
    {
        /** @var User $user */
        $user = $this->getUser();
        
        return [
            AssociationField::new('User')->setValue($user),
            AssociationField::new('Manufacturer'),
            TextField::new('Name'),
            IntegerField::new('Power16'),
            IntegerField::new('Power8'),
            IntegerField::new('Power4'),
            IntegerField::new('Power2'),
            IntegerField::new('PowerBridge8'),
            IntegerField::new('PowerBridge4'),
            BooleanField::new('Validated')

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
