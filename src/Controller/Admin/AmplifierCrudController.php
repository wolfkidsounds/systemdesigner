<?php

namespace App\Controller\Admin;

use App\Entity\Amplifier;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AmplifierCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Amplifier::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield FormField::addFieldset('General');
        yield AssociationField::new('Manufacturer')
        ->setColumns(4);
        yield TextField::new('Name', 'Name')
        ->setColumns(4);

        yield FormField::addFieldset('Details');
        yield IntegerField::new('Power16')
        ->setColumns(2);
        yield IntegerField::new('Power8')
        ->setColumns(2);
        yield IntegerField::new('Power4')
        ->setColumns(2);
        yield IntegerField::new('Power2')
        ->setColumns(2);

        yield FormField::addRow();
        yield IntegerField::new('PowerBridge8')
        ->setColumns(4);
        yield IntegerField::new('PowerBridge4')
        ->setColumns(4);

        yield FormField::addRow();
        yield TextField::new('Manual')
        ->setColumns(8);

        yield FormField::addFieldset('Settings');
        yield BooleanField::new('Validated');

        yield FormField::addFieldset('User');
        yield AssociationField::new('User')
        ->setColumns(8);
        
    }
}
