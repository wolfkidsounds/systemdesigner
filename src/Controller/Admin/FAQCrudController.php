<?php

namespace App\Controller\Admin;

use App\Entity\FAQ;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FAQCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return FAQ::class;
    }

    public function configureFields(string $pageName): iterable
{
    return [
        ChoiceField::new('Category')
            ->autocomplete()
            ->setChoices([
                'Account' => 'account',
                'Manufacturer' => 'manufacturer',
                'Processor' => 'processor',
                'Amplifier' => 'amplifier',
                'Speaker' => 'speaker',
                'Beta Program' => 'beta-program',
                'Subscription' => 'subscription',
                'Security' => 'security',
            ])
            ->renderAsBadges(),
        Field::new('Name'),
        Field::new('Description'),
    ];
}
}
