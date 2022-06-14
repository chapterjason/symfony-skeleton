<?php

namespace App\Core\Domain\Bus;

interface EventBusInterface
{
    public function dispatch(EventInterface $event): void;
}
