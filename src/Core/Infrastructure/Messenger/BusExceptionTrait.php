<?php

namespace App\Core\Infrastructure\Messenger;

use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Throwable;

trait BusExceptionTrait
{
    /**
     * @return never-return
     *
     * @throws Throwable
     */
    public function throwException(Throwable $exception): void
    {
        $exceptionToThrow = $exception;

        while ($exceptionToThrow instanceof HandlerFailedException) {
            $next = $exceptionToThrow->getPrevious();

            if (null === $next) {
                break;
            }

            $exceptionToThrow = $next;
        }

        throw $exceptionToThrow;
    }
}
