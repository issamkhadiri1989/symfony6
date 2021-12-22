<?php

declare(strict_types=1);

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraints\{Compound, NotBlank, NotNull};

/**
 * @Annotation
 */
class NotEmpty extends Compound
{
    protected function getConstraints(array $options): array
    {
        return [
            new NotNull(),
            new NotBlank(),
        ];
    }
}
