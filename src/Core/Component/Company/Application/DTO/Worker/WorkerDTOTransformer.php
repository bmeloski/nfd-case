<?php

declare(strict_types=1);

namespace App\Core\Component\Company\Application\DTO\Worker;

use App\Core\Component\Company\Domain\Worker\Worker;
use App\Core\Infrastructure\Response\DTO\Transformer\AbstractResponseDTOTransformer;

class WorkerDTOTransformer extends AbstractResponseDTOTransformer
{
    /**
     * @param Worker $worker
     *
     * @return WorkerDTO
     */
    public function transformFromObject($worker): WorkerDTO
    {
        return new WorkerDTO(
            $worker->getId(),
            $worker->getFirstName(),
            $worker->getLastName(),
            $worker->getEmail(),
            $worker->getPhoneNumber(),
            $worker->getCompany()->getId()
        );
    }

}
