<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings\Tests;

use PHPUnit\Framework\Constraint\Exception as ExceptionConstraint;
use PHPUnit\Framework\Constraint\ExceptionCode;
use PHPUnit\Framework\Constraint\ExceptionMessageIsOrContains;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Throwable;

abstract class TestCase extends PHPUnitTestCase
{
    /**
     * @param Throwable|class-string<Throwable> $expectedException
     *
     * @psalm-suppress InternalClass
     * @psalm-suppress InternalMethod
     */
    public static function assertException(
        Throwable|string $expectedException,
        callable $callback
    ): void {
        $exception = null;

        try {
            $callback();
        } catch (Throwable $exception) {
        }

        if (is_string($expectedException)) {
            static::assertThat(
                $exception,
                new ExceptionConstraint($expectedException)
            );
        } else {
            static::assertThat(
                $exception,
                new ExceptionConstraint($expectedException::class)
            );
            static::assertThat(
                $exception?->getMessage(),
                new ExceptionMessageIsOrContains($expectedException->getMessage())
            );
            static::assertThat(
                $exception?->getCode(),
                new ExceptionCode($expectedException->getCode())
            );
        }
    }
}
