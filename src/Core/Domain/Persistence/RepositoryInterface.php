<?php

namespace App\Core\Domain\Persistence;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Component\Uid\Ulid;

/**
 * Someone might say, this is part of the infrastructure and should not be in the domain.
 * The reason for this is that I will always use doctrine, do not use event sourcing
 * and do not want to deal with decorating just the doctrine repositories.
 *
 * @psalm-template T of object
 *
 * @template-implements ObjectRepository<T>
 * @template-implements Selectable<T>
 */
interface RepositoryInterface extends ObjectRepository, Selectable
{
    /**
     * @psalm-param T $entity
     */
    public function save(object $entity): void;

    /**
     * @psalm-param T $entity
     */
    public function remove(object $entity): void;

    /**
     * @psalm-return T
     */
    public function get(Ulid $uid): object;

    public function flush(): void;
}
