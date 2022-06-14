<?php

namespace App\Core\Infrastructure\Doctrine;

use App\Core\Domain\Persistence\RepositoryInterface;
use App\Core\Infrastructure\Exception\EntityNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\Uid\Ulid;

/**
 * @template T of object
 * @template-extends ServiceEntityRepository<T>
 * @template-implements RepositoryInterface<T>
 */
class Repository extends ServiceEntityRepository implements RepositoryInterface
{
    /**
     * @psalm-param T $entity
     */
    public function save(object $entity): void
    {
        $this->getEntityManager()->persist($entity);
    }

    /**
     * @psalm-param T $entity
     */
    public function remove(object $entity): void
    {
        $this->getEntityManager()->remove($entity);
    }

    /**
     * @psalm-return T
     */
    public function get(Ulid $uid): object
    {
        $entity = $this->find($uid);

        if (null === $entity) {
            throw new EntityNotFoundException($this->getClassName(), $uid);
        }

        return $entity;
    }

    public function flush(): void
    {
        $this->getEntityManager()->flush();
    }
}
