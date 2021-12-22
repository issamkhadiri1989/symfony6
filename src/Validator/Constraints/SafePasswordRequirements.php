<?php

declare(strict_types=1);

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraints\{Compound, NotBlank, NotCompromisedPassword, Regex};

/**
 * @Annotation
 */
#[\Attribute]
class SafePasswordRequirements extends Compound
{
    /**
     * Defines the set of password safety requirements.
     * - Checks if the password is not compromised
     * - Checks that it is at least not blank
     * - Check that the password has at least 8 chars containing at least 1 upper case, 1 lower case and 1 digit.
     */
    protected function getConstraints(array $options): array
    {
        return [
            new NotCompromisedPassword(),
            new NotBlank(),
            new Regex([
                'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[\w\d]{8,}$/',
            ]),
        ];
    }
}
