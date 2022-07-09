<?php

declare(strict_types=1);

namespace App\Core\Component\Company\Domain;

use App\Core\Component\Company\Domain\Address\Address;
use App\Core\Component\Company\Domain\Worker\Worker;

class Company
{
    private int $id;

    private string $name;

    private string $taxNumber;

    private Address $address;

    private array $workers = [];


    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTaxNumber(): string
    {
        return $this->taxNumber;
    }

    public function setTaxNumber(string $taxNumber): self
    {
        $this->taxNumber = $taxNumber;

        return $this;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function setAddress(Address $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getWorkers(): array
    {
        return $this->workers;
    }

    public function addWorker(Worker $worker): self
    {
        if (in_array($worker, $this->workers)) {
            $this->workers[] = $worker;
        }

        return $this;
    }
}

