<?php

declare(strict_types=1);

namespace App\Model;

use Symfony\Component\Validator\{
    Constraints as Assert,
    Context\ExecutionContextInterface,
    Mapping\ClassMetadata
};

/**
 * @Assert\Callback(callback={"App\Model\Cvv", "validCvv"})
 */
class Payment
{
    /**
     * Check this is a valid VISA card number.
     *
     * @Assert\CardScheme(schemes={"VISA", "MASTERCARD"})
     */
    private string $cardNumber;

    /**
     * This is the name of the owner.
     */
    private string $owner;

    /**
     * @Assert\NotNull()
     */
    private string $expirationDate;

    private string $cvv;

    /**
     * This method will check that the given credit card number is not blacklisted.
     *
     * @Assert\Callback()
     */
    public function creditCardWhiteListed(ExecutionContextInterface $context): void
    {
        $blackList = [
            /*This could be anything eg a database result*/
            '4916646862134397',
        ];

        if (true === \in_array($this->cardNumber, $blackList)) {
            $context->buildViolation('This CC number is blacklisted')
                ->atPath('cardNumber')
                ->addViolation();
        }
    }

    /**
     * To make things simple, it only checks that the expiration date is 99/9999 format.
     * This could, of course, be done only with Assert\Regex.
     */
    public static function expirationDateValid($object, ExecutionContextInterface $context): void
    {
        if (1 !== \preg_match('/^(\d){2}\/(\d){4}$/', $object->getExpirationDate())) {
            $context->buildViolation('The expiration date is not valid')
                ->atPath('expirationDate')
                ->addViolation();
        }
    }

    public function setCardNumber(string $cardNumber): void
    {
        $this->cardNumber = $cardNumber;
    }

    public function setExpirationDate(string $expirationDate): void
    {
        $this->expirationDate = $expirationDate;
    }

    /**
     * This class is automatically during the validation process.
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $callback = function ($object, ExecutionContextInterface $context) {
            // ... Specify here whatever validate object
        };

        $metadata->addConstraint(new Assert\Callback($callback));
    }
}
