<?php

declare(strict_types=1);

namespace App\Core\Component\Company\Application\Command\Worker;

class CreateWorkerCommand
{
    private string $firstName;
    private string $lastName;
    private string $email;
    private ?string $phoneNumber;
    private int $companyId;

    public function __construct(string $firstName, string $lastName, string $email, ?string $phoneNumber, int $companyId)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->companyId = $companyId;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function getCompanyId(): int
    {
        return $this->companyId;
    }
}
