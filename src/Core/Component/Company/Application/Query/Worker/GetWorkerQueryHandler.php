<?php

declare(strict_types=1);

namespace App\Core\Component\Company\Application\Query\Worker;

use App\Core\Component\Company\Domain\Worker\Worker;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class GetWorkerQueryHandler implements MessageHandlerInterface
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function __invoke(GetWorkerQuery $query) {
        return
            $this
                ->em
                ->createQueryBuilder()
                ->select('worker')
                ->from(Worker::class, 'worker')
                ->where('worker.id = :id')
                ->setParameter('id', $query->getId())
                ->getQuery()
                ->getOneOrNullResult();
    }
}
