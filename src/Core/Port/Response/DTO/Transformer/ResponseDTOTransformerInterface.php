<?php

declare(strict_types=1);

namespace App\Core\Port\Response\DTO\Transformer;


interface ResponseDTOTransformerInterface
{
    public function transformFromObject($object);
    public function transformFromObjects(iterable $objects): iterable;
}
