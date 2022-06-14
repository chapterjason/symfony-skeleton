<?php

namespace App\Core\Infrastructure\Messenger;

use App\Core\Domain\Bus\EventBusInterface;
use App\Core\Domain\Bus\EventInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Throwable;

final class EventBus implements EventBusInterface
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
    public function dispatch(EventInterface $event): void
    {
        try {
            $this->messageBus->dispatch($event);
        } catch (Throwable $e) {
            $this->throwException($e);
        }
    }
}
