<?php

declare(strict_types=1);

namespace App\Core\Component\Company\Application\DTO;

use App\Core\Component\Company\Application\DTO\Address\AddressDTOTransformer;
use App\Core\Component\Company\Application\DTO\Worker\WorkerDTOTransformer;
use App\Core\Infrastructure\Response\DTO\Transformer\AbstractResponseDTOTransformer;

class CompanyDTOTransformer extends AbstractResponseDTOTransformer
{
    private AddressDTOTransformer $addressTransformer;
    private WorkerDTOTransformer $workerTransformer;

    public function __construct(AddressDTOTransformer $addressTransformer, WorkerDTOTransformer $workerTransformer)
    {
        $this->addressTransformer = $addressTransformer;
        $this->workerTransformer = $workerTransformer;
    }

    public function transformFromObject($company): CompanyDTO
    {
        return new CompanyDTO(
            $company->getId(),
            $company->getName(),
            $company->getTaxNumber(),
            $this->addressTransformer->transformFromObject($company->getAddress()),
            ($company->getWorkers() ? $this->workerTransformer->transformFromObjects($company->getWorkers()) : null)
        );
    }

}
