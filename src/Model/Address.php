<?php

declare(strict_types=1);

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Address
{
    /**
     * This field summarize the address's data.
     *
     * @Assert\Collection(
     *     fields={
     *          "address" = {
     *              @Assert\NotNull,
     *              @Assert\NotBlank,
     *              @Assert\Length(min="20", max="300")
     *          },
     *          "zip_code" = @Assert\Regex("/^(\d){5}$/"),
     *          "city" = @Assert\NotNull
     *     },
     *     allowMissingFields=false,
     *     allowExtraFields=false
     * )
     */
    private array $information;

    public function addAddressInfo(string $key, string $data): self
    {
        $this->information[$key] = $data;

        return $this;
    }
}
