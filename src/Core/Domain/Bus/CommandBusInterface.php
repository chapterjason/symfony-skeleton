<?php

namespace App\Core\Domain\Bus;

interface CommandBusInterface
{
    public function dispatch(CommandInterface $command): void;
}
