<?php

declare(strict_types=1);

namespace App\Core\Component\Company\Application\Command;

use App\Core\Component\Company\Domain\Address\Address;
use App\Core\Component\Company\Domain\Company;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class UpdateCompanyCommandHandler implements MessageHandlerInterface
{
    private EntityManagerInterface $em;
    private SerializerInterface $serializer;

    public function __construct(EntityManagerInterface $em, SerializerInterface $serializer) {
        $this->em = $em;
        $this->serializer = $serializer;
    }

    public function __invoke(UpdateCompanyCommand $command) {
        $this
            ->updateCompany($command)
            ->updateAddress($command)
            ;
    }

    private function updateCompany(UpdateCompanyCommand $command): self
    {
       $query = $this
            ->em
            ->createQueryBuilder()
            ->update(Company::class, 'company')
            ->where('company.id = :id')
            ->setParameter('id', $command->getId())
       ;

       if($command->getName()) {
           $query
               ->set('company.name', ':name')
               ->setParameter('name', $command->getName());
       }

       if($command->getTaxNumber()) {
           $query
               ->set('company.taxNumber', ':taxNumber')
               ->setParameter('taxNumber', $command->getTaxNumber());
       }

       $query
           ->getQuery()
           ->execute();

       return $this;
    }

    private function updateAddress(UpdateCompanyCommand $command): self
    {
        $query = $this
            ->em
            ->createQueryBuilder()
            ->update(Address::class, 'address')
            ->where('address.company = :id')
            ->setParameter('id', $command->getId())
        ;

        if($command->getStreetAddress()) {
            $query
                ->set('address.streetAddress', ':streetAddress')
                ->setParameter('streetAddress', $command->getStreetAddress());
        }

        if($command->getCity()) {
            $query
                ->set('address.city', ':city')
                ->setParameter('city', $command->getCity());
        }

        if($command->getPostalCode()) {
            $query
                ->set('address.postalCode', ':postalCode')
                ->setParameter('postalCode', $command->getPostalCode());
        }

        $query
            ->getQuery()
            ->execute();

        return $this;
    }

}
