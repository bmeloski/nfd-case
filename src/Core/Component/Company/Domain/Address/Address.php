<?php

declare(strict_types=1);

namespace App\Core\Component\Company\Domain\Address;

use App\Core\Component\Company\Domain\Company;

class Address
{
    private int $id;
    private string $streetAddress;
    private string $city;
    private string $postalCode;
    private Company $company;

    public function __construct(?string $streetAddress = null, ?string $city = null, ?string $postalCode = null)
    {
        $streetAddress ? $this->streetAddress = $streetAddress : null;
        $city ? $this->city = $city : null;
        $postalCode ? $this->postalCode = $postalCode : null;
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function getStreetAddress(): string
    {
        return $this->streetAddress;
    }

    public function setStreetAddress(string $streetAddress): self
    {
        $this->streetAddress = $streetAddress;

        return $this;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getCompany(): Company
    {
        return $this->company;
    }

    public function setCompany(Company $company): self
    {
        $this->company = $company;

        return $this;
    }
}
