<?php

declare(strict_types=1);

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Tax
{
    private ?int $id;

    /**
     * @Assert\Sequentially(
     *     constraints={
     *          @Assert\NotBlank,
     *          @Assert\NotNull,
     *          @Assert\Regex(pattern="/^(\d){3,5}\-[A-Z]\-(\d){2}$/")
     *      }
     * )
     */
    private ?string $registrationNumber;

    private ?int $year;

    private ?int $horsePower;

    //<editor-fold desc="Getters and setters">
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegistrationNumber(): ?string
    {
        return $this->registrationNumber;
    }

    public function setRegistrationNumber(?string $registrationNumber): self
    {
        $this->registrationNumber = $registrationNumber;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getHorsePower(): ?int
    {
        return $this->horsePower;
    }

    public function setHorsePower(int $horsePower): self
    {
        $this->horsePower = $horsePower;

        return $this;
    }
    //</editor-fold>
}
