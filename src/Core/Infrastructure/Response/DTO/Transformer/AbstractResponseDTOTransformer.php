<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Response\DTO\Transformer;

use App\Core\Port\Response\DTO\Transformer\ResponseDTOTransformerInterface;

abstract class AbstractResponseDTOTransformer implements ResponseDTOTransformerInterface
{
    public function transformFromObjects(iterable $objects): iterable
    {
        $dto = [];

        foreach ($objects as $object) {
            $dto[] = $this->transformFromObject($object);
        }

        return $dto;
    }

}
