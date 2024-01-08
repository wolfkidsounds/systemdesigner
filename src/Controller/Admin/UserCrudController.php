<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Symfony\Component\Form\FormEvents;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Component\Form\FormBuilderInterface;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCrudController extends AbstractCrudController
{
    private $userPasswordHasher;

    public function __construct( UserPasswordHasherInterface $userPasswordHasher) 
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('Username')
        ->setColumns(3);

        yield ChoiceField::new('roles')
        ->allowMultipleChoices()
        ->renderAsBadges()
        ->setChoices([
            'Admin' => 'ROLE_ADMIN',
            'User' => 'ROLE_USER',
        ])
        ->setColumns(3);

        yield FormField::addRow();
        yield EmailField::new('email')
        ->setColumns(3);
        yield ChoiceField::new('locale')
        ->renderAsBadges()
        ->setChoices([
            'German' => 'de',
            'English' => 'en',
        ])
        ->setColumns(3);

        yield FormField::addRow();
        yield BooleanField::new('isVerified')
        ->setColumns(2);
        yield BooleanField::new('Subscriber')
        ->setColumns(2);
        yield BooleanField::new('Beta')
        ->setColumns(2);

        yield FormField::addRow();
        yield TextField::new('password')
        ->setFormType(RepeatedType::class)
        ->setFormTypeOptions([
            'type' => PasswordType::class,
            'first_options' => ['label' => 'Password'],
            'second_options' => ['label' => '(Repeat)'],
            'mapped' => false,
        ])
        ->setRequired($pageName === Crud::PAGE_NEW)
        ->onlyOnForms()
        ->setColumns('col-6 col-6')
        ->setColumns(3);
    }

    public function createNewFormBuilder(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormBuilderInterface
    {
        $formBuilder = parent::createNewFormBuilder($entityDto, $formOptions, $context);
        return $this->addPasswordEventListener($formBuilder);
    }

    public function createEditFormBuilder(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormBuilderInterface
    {
        $formBuilder = parent::createEditFormBuilder($entityDto, $formOptions, $context);
        return $this->addPasswordEventListener($formBuilder);
    }

    private function addPasswordEventListener(FormBuilderInterface $formBuilder): FormBuilderInterface
    {
        return $formBuilder->addEventListener(FormEvents::POST_SUBMIT, $this->hashPassword());
    }

    private function hashPassword() {
        return function($event) {
            $form = $event->getForm();
            if (!$form->isValid()) {
                return;
            }
            $password = $form->get('password')->getData();
            if ($password === null) {
                return;
            }

            $hash = $this->userPasswordHasher->hashPassword($this->getUser(), $password);
            $form->getData()->setPassword($hash);
        };
    }
}
