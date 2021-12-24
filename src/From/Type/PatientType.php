<?php

declare(strict_types=1);

namespace App\From\Type;

use App\Entity\Patient;
use Symfony\Component\Form\Extension\Core\Type\{DateType, TextType};
use Symfony\Component\Form\{AbstractType, FormBuilderInterface};
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(child: 'fullName', type: TextType::class)
            ->add(child: 'phoneNumber', type: TextType::class, options: [
                'required' => false,
                'help' => 'Phone format accepted : 09 99 99 99 99 only',
            ])
            ->add(child: 'yearOfBirth', type: DateType::class, options: [
                'required' => false,
                'widget' => 'single_text',
                'label' => 'Date of birth',
                'html5' => false,
                'format' => 'dd/MM/yyyy',
                'help' => 'The patient\'s birthdate must be (dd/mm/yyyy format). Patient under 10yo are not accepted',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Patient::class,
            'label' => false,
        ]);
    }

//    Use this function for more control of customization
//
//    public function getBlockPrefix(): string
//    {
//        return 'app_patient'; <-- Whatever you want here :)
//    }
}
