<?php

declare(strict_types=1);

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Newsletter
{
    /**
     * Assume that the list of emails either be empty or if not, all emails must be valid
     * And the list must contain unique emails.
     *
     * @Assert\AtLeastOneOf({
     *     @Assert\Count(0),
     *     @Assert\Unique,
     *     @Assert\All({
     *         @Assert\NotBlank,
     *         @Assert\NotNull,
     *         @Assert\Email
     *     })
     * })
     */
    private ?array $emails;

    public function setEmails(?array $emails): void
    {
        $this->emails = $emails;
    }
}
