<?php

declare(strict_types=1);

namespace App\Core\Component\Company\Application\Query\Worker;

class GetWorkerQuery
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
