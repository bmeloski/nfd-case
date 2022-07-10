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
    private iterable $workers;

    public function __construct(?string $name = null, ?string $taxNumber = null, ?Address $address = null)
    {
        $name ? $this->name = $name : null ;
        $taxNumber ? $this->taxNumber = $taxNumber: null ;
        $address ? $this->address = $address: null ;
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
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
        $address->setCompany($this);

        return $this;
    }

    public function getWorkers()
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

