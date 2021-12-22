<?php

declare(strict_types=1);

namespace App\Model;

use App\Validator\Constraints\{SafePasswordRequirements, SafeXssConstraint};
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Validator\Constraints as Assert;

class ChangePassword
{
    /**
     * Current user's password.
     * We use the SafePasswordRequirement compound constraint to make sure that the password is fully safe.
     *
     * @UserPassword(message="Your current password is wrong")
     * @SafePasswordRequirements()
     *
     * @SafeXssConstraint(message="The text you just entered is not safe")
     */
    private string $oldPassword;

    /**
     * The new password should not be identical to the old one.
     * We're going to use Assert\Compound assertion.
     * We use the SafePasswordRequirement compound constraint to make sure that the password is fully safe.
     *
     * @SafePasswordRequirements()
     * @Assert\NotIdenticalTo(propertyPath="oldPassword")
     *
     * @SafeXssConstraint()
     */
    private string $newPassword;

    /**
     * The user must confirm the new password.
     * We use the SafePasswordRequirement compound constraint to make sure that the password is fully safe.
     *
     * @SafePasswordRequirements()
     * @Assert\NotNull()
     * @Assert\NotBlank()
     * @Assert\IdenticalTo(propertyPath="newPassword")
     */
    private string $confirmPassword;

    public function setOldPassword(string $oldPassword): void
    {
        $this->oldPassword = $oldPassword;
    }
}
