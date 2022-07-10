<?php

declare(strict_types=1);

namespace App\Core\Component\Company\Application\Service;

use App\Core\Component\Company\Application\Query\GetCompanyQuery;
use App\Core\Component\Company\Application\Query\Worker\GetWorkerQuery;
use App\Core\Component\Company\Domain\Company;
use App\Core\Component\Company\Domain\Worker\Worker;
use App\Core\Infrastructure\Messenger\QueryBus\ResultQueryBusAdapter;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CompanyManagementService
{
    private ResultQueryBusAdapter $queryBus;
    private ValidatorInterface $validator;

    public function __construct(
        ResultQueryBusAdapter $queryBus,
        ValidatorInterface $validator
    )
    {
        $this->queryBus = $queryBus;
        $this->validator = $validator;
    }


    public function checkIfExists(int $id): ?Company
    {
        return $this->queryBus->query(new GetCompanyQuery($id));
    }

    public function checkIfWorkerExists(int $id): ?Worker
    {
        return $this->queryBus->query(new GetWorkerQuery($id));
    }
}
