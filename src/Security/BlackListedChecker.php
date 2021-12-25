<?php

declare(strict_types=1);

namespace App\Security;

use App\Entity\User;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;
use Symfony\Component\Security\Core\User\{UserCheckerInterface, UserInterface};

class BlackListedChecker implements UserCheckerInterface
{
    /**
     * This method checks if the user is trying to log in is not blacklisted.
     *
     * @param UserInterface $user the user instance
     */
    public function checkPreAuth(UserInterface $user): void
    {
        // Make sure of the correct instance:
        if (!$user instanceof User) {
            return;
        }

        $blackListedUsers = [/*This array may be everything you want. For example query it from the database*/];
        // Let's check that the connected user is blacklisted
        if (true === \in_array($user->getEmail(), $blackListedUsers)) {
            throw new CustomUserMessageAccountStatusException('Sorry, this account is blacklisted.');
        }
    }

    /**
     * This  function will check if the user is archived.
     *
     * @param UserInterface $user the user instance
     */
    public function checkPostAuth(UserInterface $user): void
    {
        // Make sure of the correct instance:
        if (!$user instanceof User) {
            return;
        }

        // A user is archived if isEnabled() === false
        if (false === $user->isEnabled()) {
            throw new CustomUserMessageAccountStatusException('This account is not enabled.');
        }
    }
}
