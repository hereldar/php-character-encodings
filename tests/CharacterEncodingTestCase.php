<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings\Tests;

use Hereldar\CharacterEncodings\CharacterEncoding;
use Hereldar\CharacterEncodings\Enums\Category;
use Hereldar\CharacterEncodings\Enums\Direction;
use Hereldar\CharacterEncodings\Enums\Script;
use Hereldar\CharacterEncodings\Utf8;

abstract class CharacterEncodingTestCase extends TestCase
{
    abstract protected static function encoding(): CharacterEncoding;

    public static function assertCharCategory(
        Category $actualCategory,
        string $character,
    ): void {
        $utf8 = Utf8::encoding();

        $utf8Character = mb_convert_encoding(
            string: $character,
            to_encoding: $utf8->name(),
            from_encoding: static::encoding()->name(),
        );

        $expectedCategory = $utf8->charCategory($utf8Character);

        static::assertSame($expectedCategory, $actualCategory);
    }

    public static function assertCharDirection(
        Direction $actualDirection,
        string $character,
    ): void {
        $utf8 = Utf8::encoding();

        $utf8Character = mb_convert_encoding(
            string: $character,
            to_encoding: $utf8->name(),
            from_encoding: static::encoding()->name(),
        );

        $expectedDirection = $utf8->charDirection($utf8Character);

        static::assertSame($expectedDirection, $actualDirection);
    }

    public static function assertCharName(
        string $actualName,
        string $character,
    ): void {
        $utf8 = Utf8::encoding();

        $utf8Character = mb_convert_encoding(
            string: $character,
            to_encoding: $utf8->name(),
            from_encoding: static::encoding()->name(),
        );

        $expectedName = $utf8->charName($utf8Character);

        static::assertSame($expectedName, $actualName);
    }

    public static function assertCharScript(
        Script $actualScript,
        string $character,
    ): void {
        $utf8 = Utf8::encoding();

        $utf8Character = mb_convert_encoding(
            string: $character,
            to_encoding: $utf8->name(),
            from_encoding: static::encoding()->name(),
        );

        $expectedScript = $utf8->charScript($utf8Character);

        static::assertSame($expectedScript, $actualScript);
    }

    public static function assertCodeCategory(
        Category $expectedCategory,
        int $codepoint,
    ): void {
        static::assertCharCategory(
            $expectedCategory,
            static::encoding()->char($codepoint)
        );
    }

    public static function assertCodeDirection(
        Direction $expectedDirection,
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
        Script $expectedScript,
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
