<?php

declare(strict_types=1);

namespace App\Core\Component\Company\Application\Command;


interface CompanyCommandInterface
{
    public function getId(): int;
    public function getName(): ?string;
    public function getTaxNumber(): ?string;
    public function getStreetAddress(): ?string;
    public function getCity(): ?string;
    public function getPostalCode(): ?string;
}
