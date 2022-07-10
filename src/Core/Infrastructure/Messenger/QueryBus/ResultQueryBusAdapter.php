<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Messenger\QueryBus;

use App\Core\Port\Messenger\QueryBus\QueryBusInterface;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class ResultQueryBusAdapter implements QueryBusInterface
{
    use HandleTrait;

    public function __construct(MessageBusInterface $queryBus)
    {
        $this->messageBus = $queryBus;
    }

    public function query($query)
    {
        return $this->handle($query);
    }
}
