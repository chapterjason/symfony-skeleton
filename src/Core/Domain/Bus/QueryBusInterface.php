<?php

namespace App\Core\Domain\Bus;

interface QueryBusInterface
{
    public function handle(QueryInterface $query): mixed;
}
