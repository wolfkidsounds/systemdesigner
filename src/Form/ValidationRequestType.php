<?php // src/Form/ValidationRequestType.php

namespace App\Form;

use App\Form\ChassisType;
use App\Form\SpeakerType;
use App\Form\ProcessorType;
use App\Entity\Manufacturer;
use App\Form\ManufacturerType;
use App\Entity\ValidationRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ValidationRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //$builder->add('Submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ValidationRequest::class,
        ]);
    }
}
