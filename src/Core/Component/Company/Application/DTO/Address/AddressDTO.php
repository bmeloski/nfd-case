<?php

declare(strict_types=1);

namespace App\Core\Component\Company\Application\DTO\Address;

final class AddressDTO
{
    private int $id;
    private string $streetAddress;
    private string $city;
    private string $postalCode;

    public function __construct(int $id, string $streetAddress, string $city, string $postalCode)
    {
        $this->id = $id;
        $this->streetAddress = $streetAddress;
        $this->city = $city;
        $this->postalCode = $postalCode;
    }

    public function getId(): int
    {
        return $this->id;
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
