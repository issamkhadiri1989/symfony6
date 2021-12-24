<?php

declare(strict_types=1);

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraints\{Compound, NotBlank, NotNull};
use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Required extends Compound
{
    /**
     * @param array<mixed> $options Mixed options
     *
     * @return Constraint[] Set of constrains
     */
    protected function getConstraints(array $options): array
    {
        return [
            new NotNull(),
            new NotBlank(),
        ];
    }
}
