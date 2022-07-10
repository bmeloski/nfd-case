<?php

declare(strict_types=1);

namespace App\Core\Component\Company\Application\Command;

use App\Core\Component\Company\Domain\Address\Address;
use App\Core\Component\Company\Domain\Company;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class CreateCompanyCommandHandler implements MessageHandlerInterface
{
    private EntityManagerInterface $em;
    private SerializerInterface $serializer;

    public function __construct(EntityManagerInterface $em, SerializerInterface $serializer) {
        $this->em = $em;
        $this->serializer = $serializer;
    }

    public function __invoke(CreateCompanyCommand $command) {
        $this->createCompany($command);
    }

    private function createCompany(CreateCompanyCommand $command)
    {
        $address = $this->createAddress($command);
        $company = new Company($command->getName(), $command->getTaxNumber(), $address);
        $company->getAddress()->setCompany($company);

        $this->em->persist($company);
        $this->em->persist($address);
    }

    private function createAddress(CreateCompanyCommand $command): Address
    {
        return new Address($command->getStreetAddress(), $command->getCity(), $command->getPostalCode());
    }

}
