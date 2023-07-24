<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings\Tests;

use Hereldar\CharacterEncodings\CharacterEncoding;
use Hereldar\CharacterEncodings\Utf8;
use PHPUnit\Framework\Constraint\Exception as ExceptionConstraint;
use PHPUnit\Framework\Constraint\ExceptionCode;
use PHPUnit\Framework\Constraint\ExceptionMessageIsOrContains;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Throwable;

abstract class TestCase extends PHPUnitTestCase
{
    abstract protected static function encoding(): CharacterEncoding;

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

    public static function assertCharCategory(
        int $expectedCategory,
        string $character,
    ): void {
        $utf8 = Utf8::encoding();

        $utf8Character = mb_convert_encoding(
            $character,
            $utf8->name(),
            static::encoding()->name()
        );

        $actualCategory = $utf8->charCategory($utf8Character);

        static::assertSame($expectedCategory, $actualCategory);
    }

    public static function assertCharDirection(
        int $expectedDirection,
        string $character,
    ): void {
        $utf8 = Utf8::encoding();

        $utf8Character = mb_convert_encoding(
            $character,
            $utf8->name(),
            static::encoding()->name()
        );

        $actualDirection = $utf8->charDirection($utf8Character);

        static::assertSame($expectedDirection, $actualDirection);
    }

    public static function assertCharName(
        string $expectedName,
        string $character,
    ): void {
        $utf8 = Utf8::encoding();

        $utf8Character = mb_convert_encoding(
            $character,
            $utf8->name(),
            static::encoding()->name()
        );

        $actualName = $utf8->charName($utf8Character);

        static::assertSame($expectedName, $actualName);
    }

    public static function assertCharScript(
        int $expectedScript,
        string $character,
    ): void {
        $utf8 = Utf8::encoding();

        $utf8Character = mb_convert_encoding(
            $character,
            $utf8->name(),
            static::encoding()->name()
        );

        $actualScript = $utf8->charScript($utf8Character);

        static::assertSame($expectedScript, $actualScript);
    }

    public static function assertCodeCategory(
        int $expectedCategory,
        int $codepoint,
    ): void {
        static::assertCharCategory(
            $expectedCategory,
            static::encoding()->char($codepoint)
        );
    }

    public static function assertCodeDirection(
        int $expectedDirection,
        int $codepoint,
    ): void {
        static::assertCharDirection(
            $expectedDirection,
            static::encoding()->char($codepoint)
        );
    }

    public static function assertCodeName(
        string $expectedName,
        int $codepoint,
    ): void {
        static::assertCharName(
            $expectedName,
            static::encoding()->char($codepoint)
        );
    }

    public static function assertCodeScript(
        int $expectedScript,
        int $codepoint,
    ): void {
        static::assertCharScript(
            $expectedScript,
            static::encoding()->char($codepoint)
        );
    }

    public function testCharCategory(): void
    {
        $encoding = static::encoding();

        foreach ($encoding->chars() as $char) {
            static::assertCharCategory(
                $encoding->charCategory($char),
                $char,
            );
        }
    }

    public function testCharDirection(): void
    {
        $encoding = static::encoding();

        foreach ($encoding->chars() as $char) {
            static::assertCharDirection(
                $encoding->charDirection($char),
                $char,
            );
        }
    }

    public function testCharName(): void
    {
        $encoding = static::encoding();

        foreach ($encoding->chars() as $char) {
            static::assertCharName(
                $encoding->charName($char),
                $char,
            );
        }
    }

    public function testCharScript(): void
    {
        $encoding = static::encoding();

        foreach ($encoding->chars() as $char) {
            static::assertCharScript(
                $encoding->charScript($char),
                $char,
            );
        }
    }

    public function testCodeCategory(): void
    {
        $encoding = static::encoding();

        foreach ($encoding->codes() as $code) {
            static::assertCodeCategory(
                $encoding->codeCategory($code),
                $code,
            );
        }
    }

    public function testCodeDirection(): void
    {
        $encoding = static::encoding();

        foreach ($encoding->codes() as $code) {
            static::assertCodeDirection(
                $encoding->codeDirection($code),
                $code,
            );
        }
    }

    public function testCodeName(): void
    {
        $encoding = static::encoding();

        foreach ($encoding->codes() as $code) {
            static::assertCodeName(
                $encoding->codeName($code),
                $code,
            );
        }
    }

    public function testCodeScript(): void
    {
        $encoding = static::encoding();

        foreach ($encoding->codes() as $code) {
            static::assertCodeScript(
                $encoding->codeScript($code),
                $code,
            );
        }
    }
}
