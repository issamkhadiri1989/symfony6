<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Model\OrderStatus;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\{AbstractType, FormBuilderInterface};

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add(
            child: 'orderState',
            type: EnumType::class,
            options: [
                'class' => OrderStatus::class,
            ]
        );
    }
}
