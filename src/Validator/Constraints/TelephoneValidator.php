<?php

declare(strict_types=1);

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Exception\{UnexpectedTypeException, UnexpectedValueException};
use Symfony\Component\Validator\{Constraint, ConstraintValidator};

class TelephoneValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof Telephone) {
            throw new UnexpectedTypeException($constraint, Telephone::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (false === \is_string($value)) {
            throw new UnexpectedValueException($value, 'string');
        }

        if (1 !== \preg_match(pattern: '/^\(0\d\)((\s(\d){2}){4})$/', subject: $value)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
