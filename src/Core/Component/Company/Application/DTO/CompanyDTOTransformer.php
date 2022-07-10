<?php

declare(strict_types=1);

namespace App\Core\Component\Company\Application\DTO;

use App\Core\Component\Company\Application\DTO\Address\AddressDTOTransformer;
use App\Core\Component\Company\Application\DTO\Worker\WorkerDTOTransformer;
use App\Core\Component\Company\Domain\Address\Address;
use App\Core\Component\Company\Domain\Company;
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
            $company->getName(),
            $company->getTaxNumber(),
            $this->addressTransformer->transformFromObject($company->getAddress()),
            $company->getId(),
            ($company->getWorkers() ? $this->workerTransformer->transformFromObjects($company->getWorkers()) : null)
        );
    }

    public function transferToObject(CompanyDTO $companyDTO): Company
    {
        $company = new Company();

        if($companyDTO->getId()) {
            $company->setId($companyDTO->getId());
        }

        $company
            ->setName($companyDTO->getName())
            ->setTaxNumber($companyDTO->getTaxNumber());

        $address = new Address();

        $address
            ->setStreetAddress($companyDTO->getAddress()->getStreetAddress())
            ->setCity($companyDTO->getAddress()->getCity())
            ->setPostalCode($companyDTO->getAddress()->getPostalCode());

        $company->setAddress($address);

        return $company;
    }
}
