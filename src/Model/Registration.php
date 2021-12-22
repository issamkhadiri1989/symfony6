<?php

declare(strict_types=1);

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Registration
{
    /**
     * The system should accept only people whose age > 10.
     *
     * @Assert\GreaterThan(value="10")
     */
    private int $age;

    /**
     * The description must not be blank and should contain at least 30 chars and must ne exceed 300 chars.
     *
     * @Assert\NotBlank()
     * @Assert\Length(min="30", max="300")
     */
    private string $description;

    /**
     * The user's fullname.
     *
     * @Assert\NotNull()
     * @Assert\NotBlank()
     */
    private ?string $name;

    /**
     * The user's password.
     *
     * @Assert\NotIdenticalTo(propertyPath="name")
     */
    private string $password;

    /**
     * Because we need to confirm the password, the user must confirm it.
     *
     * @Assert\IdenticalTo(propertyPath="password")
     */
    private string $passwordConfirmation;

    /**
     * @Assert\IsTrue(message="Your password is not strong enough")
     */
    public function isPasswordStrong(): bool
    {
        return 1 === \preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[\w\d]{8,}$/', $this->password);
    }
}
