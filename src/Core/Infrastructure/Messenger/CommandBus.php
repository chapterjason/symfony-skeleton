<?php

namespace App\Core\Infrastructure\Messenger;

use App\Core\Domain\Bus\CommandBusInterface;
use App\Core\Domain\Bus\CommandInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Throwable;

final class CommandBus implements CommandBusInterface
{
    use BusExceptionTrait;

    private MessageBusInterface $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    /**
     * @throws Throwable
     */
    public function dispatch(CommandInterface $command): void
    {
        try {
            $this->messageBus->dispatch($command);
        } catch (Throwable $e) {
            $this->throwException($e);
        }
    }
}
