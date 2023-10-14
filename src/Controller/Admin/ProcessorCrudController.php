<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Processor;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Text;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProcessorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Processor::class;
    }

    public function configureFields(string $processor): iterable
    {
        /** @var User $user */
        $user = $this->getUser();
        
        return [
            AssociationField::new('User')->setValue($user),
            AssociationField::new('Manufacturer'),
            TextField::new('name'),
            IntegerField::new('channels_input'),
            IntegerField::new('channels_output'),
            IntegerField::new('output_offset'),
            BooleanField::new('validated')

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
