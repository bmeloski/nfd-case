<?php

declare(strict_types=1);

namespace App\Core\Component\Company\Application\DTO\Worker;

use App\Core\Component\Company\Application\Service\CompanyManagementService;
use App\Core\Component\Company\Domain\Worker\Worker;
use App\Core\Infrastructure\Response\DTO\Transformer\AbstractResponseDTOTransformer;

class WorkerDTOTransformer extends AbstractResponseDTOTransformer
{
    private CompanyManagementService $companyManagementService;

    public function __construct(CompanyManagementService $companyManagementService)
    {
        $this->companyManagementService = $companyManagementService;
    }


    /**
     * @param Worker $worker
     *
     * @return WorkerDTO
     */
    public function transformFromObject($worker): WorkerDTO
    {
        return new WorkerDTO(
            $worker->getFirstName(),
            $worker->getLastName(),
            $worker->getEmail(),
            $worker->getPhoneNumber(),
            $worker->getCompany()->getId(),
            $worker->getId()
        );
    }

    public function transferToObject(WorkerDTO $workerDTO): Worker
    {
        $worker = new Worker();

        if($workerDTO->getId()) {
            $worker->setId($workerDTO->getId());
        }

        $worker
            ->setFirstName($workerDTO->getFirstName())
            ->setLastName($workerDTO->getLastName())
            ->setEmail($workerDTO->getEmail())
            ->setPhoneNumber($workerDTO->getPhoneNumber())
            ->setCompany($this->companyManagementService->checkIfExists($workerDTO->getCompanyId()))
        ;

        return $worker;
    }

}
