<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Manufacturer;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class ManufacturerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Manufacturer::class;
    }

    public function configureFields(string $manufacturer): iterable
    {
        /** @var User $user */
        $user = $this->getUser();

        return [
            AssociationField::new('User')->setValue($user),
            TextField::new('Name'),
            BooleanField::new('validated')

        ];
    }
}
