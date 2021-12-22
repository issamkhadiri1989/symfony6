<?php

declare(strict_types=1);

namespace App\Model;

use App\Validator\Constraints\NotEmpty;
use Symfony\Component\Validator\Constraints as Assert;

class Shipment
{
    /**
     * @NotEmpty
     */
    private string $address;

    /**
     * @NotEmpty
     * @Assert\Regex(
     *     pattern="/^(0\d{1}|(00)\d{3})(\s(\d){2}){4}$/",
     *     message="The phone number format is not a valid `09|00999 99 99 99 99`",
     *     groups={"registration"}
     * )
     */
    private string $phoneNumber;

    /**
     * @NotEmpty
     */
    private string $zipCode;

    /**
     * @NotEmpty
     */
    private string $city;

    //<editor-fold desc="Setters and Getters">

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): void
    {
        $this->zipCode = $zipCode;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    //</editor-fold>
}
