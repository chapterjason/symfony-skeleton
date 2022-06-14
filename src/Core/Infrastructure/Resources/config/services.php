<?php

use App\Core\Domain\Bus\CommandBusInterface;
use App\Core\Domain\Bus\EventBusInterface;
use App\Core\Domain\Bus\QueryBusInterface;
use App\Core\Infrastructure\Messenger\CommandBus;
use App\Core\Infrastructure\Messenger\EventBus;
use App\Core\Infrastructure\Messenger\QueryBus;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return function (ContainerConfigurator $container) {
    $services = $container->services();

    $services->set(CommandBus::class)
        ->args([
            service('messenger.bus.command'),
        ]);

    $services->alias(CommandBusInterface::class, CommandBus::class)
        ->public();

    $services->set(EventBus::class)
        ->args([
            service('messenger.bus.event'),
        ]);

    $services->alias(EventBusInterface::class, EventBus::class)
        ->public();

    $services->set(QueryBus::class)
        ->args([
            service('messenger.bus.query'),
        ]);

    $services->alias(QueryBusInterface::class, QueryBus::class);
};
