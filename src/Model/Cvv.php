<?php

declare(strict_types=1);

namespace App\Model;

use Symfony\Component\Validator\Context\ExecutionContextInterface;

class Cvv
{
    public static function validCvv($object, ExecutionContextInterface $context): void
    {
        // ... Do some logic here to validate the CVV.

        /*$context->buildViolation('This is not a valid CVV')
            ->atPath('cvv')
            ->addViolation();*/
    }
}
