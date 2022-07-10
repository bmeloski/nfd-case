<?php

declare(strict_types=1);

namespace App\Core\Component\Company\Application\Command\Worker;

use App\Core\Component\Company\Domain\Worker\Worker;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class DeleteWorkerCommandHandler implements MessageHandlerInterface
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    public function __invoke(DeleteWorkerCommand $command) {
        $this->deleteCompany($command);
    }

    private function deleteCompany(DeleteWorkerCommand $command): self
    {
       $this
            ->em
            ->createQueryBuilder()
            ->delete(Worker::class, 'worker')
            ->where('worker.id = :id')
            ->setParameter('id', $command->getId())
            ->getQuery()
            ->execute();

       return $this;
    }
}
