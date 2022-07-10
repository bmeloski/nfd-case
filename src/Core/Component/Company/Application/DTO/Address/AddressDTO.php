<?php

declare(strict_types=1);

namespace App\Core\Component\Company\Application\DTO\Address;

final class AddressDTO
{
    private string $streetAddress;
    private string $city;
    private string $postalCode;

    public function __construct(string $streetAddress, string $city, string $postalCode)
    {
        $this->streetAddress = $streetAddress;
        $this->city = $city;
        $this->postalCode = $postalCode;
    }

    public function getStreetAddress(): string
    {
        return $this->streetAddress;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }


}
