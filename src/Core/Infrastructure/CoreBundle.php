<?php

namespace App\Core\Infrastructure;

use App\Core\Domain\Bus\CommandHandlerInterface;
use App\Core\Domain\Bus\EventHandlerInterface;
use App\Core\Domain\Bus\QueryHandlerInterface;
use App\Core\Infrastructure\Doctrine\Repository;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class CoreBundle extends AbstractBundle
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->import(__DIR__ . '/Resources/config/services.php');

        $builder->registerForAutoconfiguration(CommandHandlerInterface::class)
            ->addTag('messenger.message_handler', ['bus' => 'messenger.bus.command']);

        $builder->registerForAutoconfiguration(QueryHandlerInterface::class)
            ->addTag('messenger.message_handler', ['bus' => 'messenger.bus.query']);

        $builder->registerForAutoconfiguration(EventHandlerInterface::class)
            ->addTag('messenger.message_handler', ['bus' => 'messenger.bus.event']);
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function prependExtension(ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->extension('doctrine', [
            'orm' => ['default_repository_class' => Repository::class],
        ]);
    }
}
