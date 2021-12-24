<?php

declare(strict_types=1);

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
#[\Attribute]
class Telephone extends Constraint
{
    public string $message = 'This is not a valid phone number';
}
