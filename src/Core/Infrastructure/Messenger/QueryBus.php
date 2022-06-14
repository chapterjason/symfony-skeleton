<?php

namespace App\Core\Infrastructure\Messenger;

use App\Core\Domain\Bus\QueryBusInterface;
use App\Core\Domain\Bus\QueryInterface;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Throwable;

final class QueryBus implements QueryBusInterface
{
    use HandleTrait;
    use BusExceptionTrait;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    /**
     * @throws Throwable
     */
    public function handle(QueryInterface $query): mixed
    {
        try {
            return $this->handle($query);
        } catch (Throwable $exception) {
            $this->throwException($exception);
        }
    }
}
