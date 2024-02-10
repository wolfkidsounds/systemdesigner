<?php

namespace App\Controller\Admin;

use App\Entity\Manufacturer;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ManufacturerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Manufacturer::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield FormField::addFieldset('General');
        yield TextField::new('Name', 'Name');
        yield ChoiceField::new('Category')
        ->allowMultipleChoices()
        ->renderAsBadges()
        ->setChoices([
            'Amplifier' => 'amplifier',
            'Processor' => 'processor',
            'Speaker' => 'speaker',
            'Chassis' => 'chassis',
        ]);

        yield FormField::addFieldset('Settings');
        yield BooleanField::new('Validated');

        yield FormField::addFieldset('User');
        yield AssociationField::new('User');
    }
}
