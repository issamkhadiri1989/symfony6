<?php

declare(strict_types=1);

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Assert\GroupSequence({"Profile", "payment"})
 */
class Profile
{
    /**
     * User's full name.
     *
     * @Assert\NotNull()
     */
    private ?string $name;

    /**
     * User's address.
     *
     * @Assert\NotNull(groups={"edit"})
     */
    private ?string $address;

    /**
     * The card number.
     *
     * @Assert\CardScheme({"VISA", "MASTERCARD"}, groups={"payment"})
     */
    private ?string $cardNumber;

    //<editor-fold desc="Getters and setters">

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCardNumber(): ?string
    {
        return $this->cardNumber;
    }

    public function setCardNumber(?string $cardNumber): self
    {
        $this->cardNumber = $cardNumber;

        return $this;
    }

    //</editor-fold>
}
