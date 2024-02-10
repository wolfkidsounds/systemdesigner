<?php

namespace App\Controller\Admin;

use App\Entity\Processor;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProcessorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Processor::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield FormField::addFieldset('General');
        yield AssociationField::new('Manufacturer')
        ->setColumns(4);
        yield TextField::new('Name', 'Name')
        ->setColumns(4);

        yield FormField::addFieldset('Details');
        yield IntegerField::new('ChannelsInput')
        ->setColumns(2);
        yield IntegerField::new('ChannelsOutput')
        ->setColumns(2);
        yield IntegerField::new('OutputOffset')
        ->setColumns(2);

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
