<?php

declare(strict_types=1);

namespace App\Core\Component\Company\Application\Command;

class UpdateCompanyCommand implements CompanyCommandInterface
{
    private int $id;
    private ?string $name;
    private ?string $taxNumber;
    private ?string $streetAddress;
    private ?string $city;
    private ?string $postalCode;

    public function __construct(int $id, ?string $name, ?string $taxNumber, ?string $streetAddress, ?string $city, ?string $postalCode)
    {
        $this->id = $id;
        $this->name = $name;
        $this->taxNumber = $taxNumber;
        $this->streetAddress = $streetAddress;
        $this->city = $city;
        $this->postalCode = $postalCode;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getTaxNumber(): ?string
    {
        return $this->taxNumber;
    }

    public function getStreetAddress(): ?string
    {
        return $this->streetAddress;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }


}
