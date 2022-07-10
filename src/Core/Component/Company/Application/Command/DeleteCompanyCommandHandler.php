<?php

declare(strict_types=1);

namespace App\Core\Component\Company\Application\Command;

use App\Core\Component\Company\Domain\Company;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class DeleteCompanyCommandHandler implements MessageHandlerInterface
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    public function __invoke(DeleteCompanyCommand $command) {
        $this->deleteCompany($command);
    }

    private function deleteCompany(DeleteCompanyCommand $command): self
    {
       $this
            ->em
            ->createQueryBuilder()
            ->delete(Company::class, 'company')
            ->where('company.id = :id')
            ->setParameter('id', $command->getId())
            ->getQuery()
            ->execute();

       return $this;
    }
}
