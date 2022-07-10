<?php

declare(strict_types=1);

namespace App\Core\Component\Company\Application\DTO;

use App\Core\Component\Company\Application\DTO\Address\AddressDTO;

final class CompanyDTO
{
    private int $id;
    private string $name;
    private string $taxNumber;
    private AddressDTO $address;
    private ?iterable $workers;

    public function __construct(
        int $id,
        string $name,
        string $taxNumber,
        AddressDTO $address,
        ?iterable $workers
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->taxNumber = $taxNumber;
        $this->address = $address;
        $this->workers = $workers;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTaxNumber(): string
    {
        return $this->taxNumber;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getWorkers()
    {
        return $this->workers;
    }
}
