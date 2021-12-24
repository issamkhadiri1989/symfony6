<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\PatientRepository;
use App\Validator\Constraints\{Required, Telephone};
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PatientRepository::class)
 */
class Patient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @Required()
     * @ORM\Column(type="string", length=255)
     */
    private ?string $fullName;

    /**
     * @Required()
     * @Assert\LessThan("-10 years")
     * @ORM\Column(type="date")
     */
    private ?\DateTimeInterface $yearOfBirth;

    /**
     * @Required()
     * @Telephone()
     * @ORM\Column(type="string", length=100)
     */
    private ?string $phoneNumber;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getYearOfBirth(): ?\DateTimeInterface
    {
        return $this->yearOfBirth;
    }

    public function setYearOfBirth(?\DateTimeInterface $yearOfBirth): self
    {
        $this->yearOfBirth = $yearOfBirth;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }
}
