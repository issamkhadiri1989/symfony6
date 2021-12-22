<?php

declare(strict_types=1);

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Author
{
    public const TITLE = ['MR', 'MME'];

    /**
     * MR and MME are the only values allowed.
     *
     * @Assert\Choice(Author::TITLE, message="The {{value}} is not a valid choice")
     */
    private ?string $title;

    /**
     * The author's name must not be null.
     *
     * @Assert\NotNull()
     */
    private ?string $name;

    /**
     * Assume that the author's year of birth is between 1900 and 2000.
     *
     * @Assert\Choice(
     *     callback={"App\Model\Year", "yearsOf20Century"},
     *     message="The year {{ value }} is not supported"
     * )
     */
    private ?int $yearOfBirth;

    /**
     * Using a simple static method to provide list of available choices.
     *
     * @Assert\Choice(callback="choicesProvider")
     */
    private ?string $choice;

    public static function choicesProvider(): array
    {
        return ['Choice 1', 'Choice 2', 'Choice 3'];
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getYearOfBirth(): ?int
    {
        return $this->yearOfBirth;
    }

    public function setYearOfBirth(?int $yearOfBirth): void
    {
        $this->yearOfBirth = $yearOfBirth;
    }

    public function getChoice(): ?string
    {
        return $this->choice;
    }

    public function setChoice(?string $choice): void
    {
        $this->choice = $choice;
    }
}
