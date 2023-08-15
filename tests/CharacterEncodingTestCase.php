<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings\Tests;

use Generator;
use Hereldar\CharacterEncodings\CharacterEncoding;
use Hereldar\CharacterEncodings\Enums\Category;
use Hereldar\CharacterEncodings\Enums\Direction;
use Hereldar\CharacterEncodings\Enums\Script;
use Hereldar\CharacterEncodings\Exceptions\InvalidCharacter;
use Hereldar\CharacterEncodings\Exceptions\InvalidCodepoint;
use Hereldar\CharacterEncodings\Utf8;
use PHPUnit\Framework\Attributes\DataProvider;

abstract class CharacterEncodingTestCase extends TestCase
{
    abstract public static function encoding(): CharacterEncoding;

    /**
     * @return Generator<int>
     */
    public static function codepoints(): Generator
    {
        $encoding = static::encoding();

        $start = max($encoding->minCodepoint() - 1, 0);
        $end = $encoding->maxCodepoint() + 1;

        for ($code = $start; $code < $end; ++$code) {
            yield $code;
        }
    }

    public function testCodeCategory(): void
    {
        $encoding = static::encoding();

        foreach (static::codepoints() as $codepoint) {
            if ($encoding->codeIsValid($codepoint)) {
                $character = $encoding->char($codepoint);
                $utf8Character = static::convertToUtf8($character);

                $actualCategory = $encoding->codeCategory($codepoint);
                $expectedCategory = Utf8::encoding()->charCategory($utf8Character);

                static::assertSame($expectedCategory, $actualCategory);
            } else {
                static::assertException(
                    new InvalidCodepoint($encoding, $codepoint),
                    fn () => $encoding->codeCategory($codepoint),
                );
            }
        }
    }

    public function testCodeDirection(): void
    {
        $encoding = static::encoding();

        foreach (static::codepoints() as $codepoint) {
            if ($encoding->codeIsValid($codepoint)) {
                $character = $encoding->char($codepoint);
                $utf8Character = static::convertToUtf8($character);

                $actualDirection = $encoding->codeDirection($codepoint);
                $expectedDirection = Utf8::encoding()->charDirection($utf8Character);

                static::assertSame($expectedDirection, $actualDirection);
            } else {
                static::assertException(
                    new InvalidCodepoint($encoding, $codepoint),
                    fn () => $encoding->codeDirection($codepoint),
                );
            }
        }
    }

    public function testCodeName(): void
    {
        $encoding = static::encoding();

        foreach (static::codepoints() as $codepoint) {
            if ($encoding->codeIsValid($codepoint)) {
                $character = $encoding->char($codepoint);
                $utf8Character = static::convertToUtf8($character);

                $actualName = $encoding->codeName($codepoint);
                $expectedName = Utf8::encoding()->charName($utf8Character);

                static::assertSame($expectedName, $actualName);
            } else {
                static::assertException(
                    new InvalidCodepoint($encoding, $codepoint),
                    fn () => $encoding->codeName($codepoint),
                );
            }
        }
    }

    public function testCodeScript(): void
    {
        $encoding = static::encoding();

        foreach (static::codepoints() as $codepoint) {
            if ($encoding->codeIsValid($codepoint)) {
                $character = $encoding->char($codepoint);
                $utf8Character = static::convertToUtf8($character);

                $actualScript = $encoding->codeScript($codepoint);
                $expectedScript = Utf8::encoding()->charScript($utf8Character);

                static::assertSame($expectedScript, $actualScript);
            } else {
                static::assertException(
                    new InvalidCodepoint($encoding, $codepoint),
                    fn () => $encoding->codeScript($codepoint),
                );
            }
        }
    }

    /**
     * @return Generator<string>
     */
    abstract public static function characters(): Generator;

    public function testCharCategory(): void
    {
        $encoding = static::encoding();

        foreach (static::characters() as $character) {
            if ($encoding->charIsValid($character)) {
                $utf8Character = static::convertToUtf8($character);

                $actualCategory = $encoding->charCategory($character);
                $expectedCategory = Utf8::encoding()->charCategory($utf8Character);

                static::assertSame($expectedCategory, $actualCategory);
            } else {
                static::assertException(
                    new InvalidCharacter($encoding, $character),
                    fn () => $encoding->charCategory($character),
                );
            }
        }
    }

    public function testCharDirection(): void
    {
        $encoding = static::encoding();

        foreach (static::characters() as $character) {
            if ($encoding->charIsValid($character)) {
                $utf8Character = static::convertToUtf8($character);

                $actualDirection = $encoding->charDirection($character);
                $expectedDirection = Utf8::encoding()->charDirection($utf8Character);

                static::assertSame($expectedDirection, $actualDirection);
            } else {
                static::assertException(
                    new InvalidCharacter($encoding, $character),
                    fn () => $encoding->charDirection($character),
                );
            }
        }
    }

    public function testCharName(): void
    {
        $encoding = static::encoding();

        foreach (static::characters() as $character) {
            if ($encoding->charIsValid($character)) {
                $utf8Character = static::convertToUtf8($character);

                $actualName = $encoding->charName($character);
                $expectedName = Utf8::encoding()->charName($utf8Character);

                static::assertSame($expectedName, $actualName);
            } else {
                static::assertException(
                    new InvalidCharacter($encoding, $character),
                    fn () => $encoding->charName($character),
                );
            }
        }
    }

    public function testCharScript(): void
    {
        $encoding = static::encoding();

        foreach (static::characters() as $character) {
            if ($encoding->charIsValid($character)) {
                $utf8Character = static::convertToUtf8($character);

                $actualScript = $encoding->charScript($character);
                $expectedScript = Utf8::encoding()->charScript($utf8Character);

                static::assertSame($expectedScript, $actualScript);
            } else {
                static::assertException(
                    new InvalidCharacter($encoding, $character),
                    fn () => $encoding->charScript($character),
                );
            }
        }
    }

    protected static function convertToUtf8(string $character): string
    {
        $toEncoding = Utf8::encoding();
        $fromEncoding = static::encoding();

        if ($toEncoding === $fromEncoding) {
            return $character;
        }

        /** @var string|false $utf8Character */
        $utf8Character = mb_convert_encoding(
            $character,
            $toEncoding->name(),
            $fromEncoding->name(),
        );

        if ($utf8Character === false) {
            throw new InvalidCharacter($fromEncoding, $character);
        }

        return $utf8Character;
    }
}
