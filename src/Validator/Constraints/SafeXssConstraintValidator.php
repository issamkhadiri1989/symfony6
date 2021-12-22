<?php

declare(strict_types=1);

namespace App\Validator\Constraints;

//<editor-fold desc="Use statements">

use Symfony\Component\Validator\Exception\{UnexpectedTypeException, UnexpectedValueException};
use Symfony\Component\Validator\{Constraint, ConstraintValidator};

//</editor-fold>

class SafeXssConstraintValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint)
    {
        // Make sure that we are validating the right constraint
        if (!$constraint instanceof SafeXssConstraint) {
            throw new UnexpectedTypeException(value: $constraint, expectedType: Constraint::class);
        }

        // Do nothing
        if (null === $value || '' === $value) {
            return;
        }

        // Because the field must always be a string
        if (false === \is_string($value)) {
            throw new UnexpectedValueException(value: $value, expectedType: 'string');
        }

        // Now that we are sure that all previous tests are OK,
        // Check that the 2 strings become different after calling strip_tags
        if (\strip_tags($value) !== $value) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }
}
