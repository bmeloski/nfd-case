<?php

declare(strict_types=1);

namespace App\Core\Component\Company\Application\Command\Worker;

class UpdateWorkerCommand
{
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $email;
    private ?string $phoneNumber;
    private int $companyId;

    public function __construct(int $id, string $firstName, string $lastName, string $email, ?string $phoneNumber, int $companyId)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->companyId = $companyId;
    }

    public function getId(): int
    {
        return $this->id;
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
