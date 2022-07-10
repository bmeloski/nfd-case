<?php

declare(strict_types=1);

namespace App\Core\Component\Company\Application\Command\Worker;

use App\Core\Component\Company\Domain\Company;
use App\Core\Component\Company\Domain\Worker\Worker;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class UpdateWorkerCommandHandler implements MessageHandlerInterface
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    public function __invoke(UpdateWorkerCommand $command) {
        $this->updateWorker($command);
    }

    private function updateWorker(UpdateWorkerCommand $command): void
    {
       $query = $this
            ->em
            ->createQueryBuilder()
            ->update(Worker::class, 'worker')
            ->where('worker.id = :id')
            ->setParameter('id', $command->getId())
            ->set('worker.firstName', ':firstName')
            ->setParameter('firstName', $command->getFirstName())
            ->set('worker.lastName', ':lastName')
            ->setParameter('lastName', $command->getLastName())
            ->set('worker.email', ':email')
            ->setParameter('email', $command->getEmail())
            ->set('worker.company', ':company')
            ->setParameter('company', $this->em->getReference(Company::class, $command->getCompanyId()));

       if($command->getPhoneNumber()) {
           $query
               ->set('worker.phoneNumber', ':phoneNumber')
               ->setParameter('phoneNumber', $command->getPhoneNumber());
       }

       $query
           ->getQuery()
           ->execute();
    }
}
