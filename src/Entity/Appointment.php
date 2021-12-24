<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\AppointmentRepository;
use App\Validator\Constraints\Required;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AppointmentRepository::class)
 */
class Appointment
{
    public const STATES = ['Confirmed', 'Canceled'];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @Required()
     * @ORM\Column(type="datetime")
     */
    private ?\DateTimeInterface $startDate;

    /**
     * @Assert\Sequentially({
     *     @Required(),
     *     @Assert\Length(min="20", max="300")
     * })
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $description;

    /**
     * @Required()
     * @ORM\Column(type="integer")
     */
    private ?int $duration;

    /**
     * @Required()
     * @ORM\Column(type="string", length=10)
     * @Assert\Choice(Appointment::STATES)
     */
    private ?string $state;

    /**
     * Because this object must be validated too.
     *
     * @Assert\NotNull()
     * @Assert\Valid()
     *
     * @ORM\OneToOne(targetEntity=Patient::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Patient $patient;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        $this->patient = $patient;

        return $this;
    }
}
