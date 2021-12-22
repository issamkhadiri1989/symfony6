<?php

declare(strict_types=1);

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Checkout
{
    /**
     * @Assert\NotNull()
     */
    private ?\DateTimeInterface $checkoutDate;

    /**
     * @Assert\Valid(groups={"registration"})
     */
    private ?Shipment $shipmentAddress;

    public function getCheckoutDate(): ?\DateTimeInterface
    {
        return $this->checkoutDate;
    }

    public function setCheckoutDate(?\DateTimeInterface $checkoutDate): self
    {
        $this->checkoutDate = $checkoutDate;

        return $this;
    }

    public function getShipmentAddress(): ?Shipment
    {
        return $this->shipmentAddress;
    }

    public function setShipmentAddress(?Shipment $shipmentAddress): self
    {
        $this->shipmentAddress = $shipmentAddress;

        return $this;
    }
}
