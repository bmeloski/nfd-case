<?php

declare(strict_types=1);

namespace App\Core\Component\Company\Application\Command\Worker;

use App\Core\Component\Company\Domain\Company;
use App\Core\Component\Company\Domain\Worker\Worker;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateWorkerCommandHandler implements MessageHandlerInterface
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    public function __invoke(CreateWorkerCommand $command) {
        $this->createWorker($command);
    }

    private function createWorker(CreateWorkerCommand $command)
    {
        $worker = new Worker(
            $command->getFirstName(),
            $command->getLastName(),
            $command->getEmail(),
            $command->getPhoneNumber(),
            $this->em->getReference(Company::class, $command->getCompanyId())
        );

        $this->em->persist($worker);
    }
}
