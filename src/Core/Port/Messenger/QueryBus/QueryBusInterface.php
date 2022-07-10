<?php

declare(strict_types=1);

namespace App\Core\Port\Messenger\QueryBus;

interface QueryBusInterface
{
    public function query($query);
}
