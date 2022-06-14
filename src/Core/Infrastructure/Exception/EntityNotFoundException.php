<?php

namespace App\Core\Infrastructure\Exception;

use Symfony\Component\Uid\Ulid;

class EntityNotFoundException extends InvalidArgumentException
{
    /**
     * @var class-string
     */
    private string $entityClassName;

    private Ulid $entityId;

    /**
     * @param class-string $entityClassName
     */
    public function __construct(string $entityClassName, Ulid $entityId)
    {
        $this->entityClassName = $entityClassName;
        $this->entityId = $entityId;

        parent::__construct(
            sprintf(
                'Entity %s with id %s not found',
                $entityClassName,
                (string) $entityId
            )
        );
    }

    public function getEntityClassName(): string
    {
        return $this->entityClassName;
    }

    public function getEntityId(): Ulid
    {
        return $this->entityId;
    }
}
