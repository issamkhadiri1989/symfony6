<?php

declare(strict_types=1);

namespace App\From\Type;

use App\Entity\Appointment;
use Symfony\Component\Form\Extension\Core\Type\{ChoiceType, DateTimeType, NumberType, TextareaType};
use Symfony\Component\Form\{AbstractType, FormBuilderInterface};
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppointmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                child: 'description',
                type: TextareaType::class,
                options: ['required' => false]
            )
            ->add(
                child: 'duration',
                type: NumberType::class,
                options: ['required' => false]
            )
            ->add(
                child: 'patient',
                type: PatientType::class,
                options: ['required' => false]
            )
            ->add(
                child: 'startDate',
                type: DateTimeType::class,
                options: ['widget' => 'single_text', 'required' => false]
            )
            ->add(
                child: 'state',
                type: ChoiceType::class,
                options: [
                    'choices' => \array_combine(Appointment::STATES, Appointment::STATES),
                    'required' => false,
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Appointment::class,
        ]);
    }

//    public function getBlockPrefix(): string
//    {
//        return 'ipsum';
//    }
}
