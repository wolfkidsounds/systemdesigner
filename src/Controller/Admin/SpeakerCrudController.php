<?php

namespace App\Controller\Admin;

use App\Entity\Speaker;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SpeakerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Speaker::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield FormField::addFieldset('General');
        yield AssociationField::new('Manufacturer')
        ->setColumns(4);
        yield TextField::new('Name', 'Name')
        ->setColumns(4);

        yield FormField::addFieldset('Details');
        yield IntegerField::new('PowerRMS')
        ->setColumns(2);
        yield IntegerField::new('PowerPeak')
        ->setColumns(2);
        yield IntegerField::new('Impedance')
        ->setColumns(2);
        yield IntegerField::new('SPL')
        ->setColumns(2);
        
        yield FormField::addRow();
        yield ChoiceField::new('Bandwidth')
        ->setColumns(8)
        ->renderAsBadges()
        ->setChoices([
            'Full Range ( 20Hz - 20kHz )' => 'FR',
            'Subwoofer ( < 200Hz )' => 'SUB',
            'Low Fequency ( < 500Hz )' => 'LF',
            'Mid Fequency ( 500Hz - 2kHz )' => 'MF',
            'High Fequency ( > 2kHz )' => 'HF',
        ]);

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
