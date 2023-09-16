<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings\Tests;

use Closure;
use Generator;
use Hereldar\CharacterEncodings\CharacterEncoding;
use Hereldar\CharacterEncodings\Exceptions\InvalidCharacter;
use Hereldar\CharacterEncodings\Exceptions\InvalidCodepoint;
use Hereldar\CharacterEncodings\Utf8;
use IntlChar;

use function Hereldar\CharacterEncodings\str_represent;

abstract class CharacterEncodingTestCase extends TestCase
{
    abstract public static function encoding(): CharacterEncoding;

    /**
     * @return Generator<string>
     */
    abstract public static function characters(): Generator;

    public function testCharCategory(): void
    {
        static::assertChar(
            Utf8::encoding()->charCategory(...),
            static::encoding()->charCategory(...),
        );
    }

    public function testCharDirection(): void
    {
        static::assertChar(
            Utf8::encoding()->charDirection(...),
            static::encoding()->charDirection(...),
        );
    }

    public function testCharName(): void
    {
        static::assertChar(
            Utf8::encoding()->charName(...),
            static::encoding()->charName(...),
        );
    }

    public function testCharScript(): void
    {
        static::assertChar(
            Utf8::encoding()->charScript(...),
            static::encoding()->charScript(...),
        );
    }

    public function testCharIsControl(): void
    {
        static::assertChar(
            fn ($utf8Character) => !IntlChar::isprint($utf8Character),
            static::encoding()->charIsControl(...),
        );
    }

    public function testCharIsDigit(): void
    {
        static::assertChar(
            IntlChar::isdigit(...),
            static::encoding()->charIsDigit(...),
        );
    }

    public function testCharIsLetter(): void
    {
        static::assertChar(
            IntlChar::isalpha(...),
            static::encoding()->charIsLetter(...),
        );
    }

    public function testCharIsLetterOrDigit(): void
    {
        static::assertChar(
            IntlChar::isalnum(...),
            static::encoding()->charIsLetterOrDigit(...),
        );
    }

    public function testCharIsLetterOrNumber(): void
    {
        static::assertChar(
            fn ($utf8Character) => (
                IntlChar::isalpha($utf8Character)
                || match (IntlChar::charType($utf8Character)) {
                    IntlChar::CHAR_CATEGORY_DECIMAL_DIGIT_NUMBER,
                    IntlChar::CHAR_CATEGORY_LETTER_NUMBER,
                    IntlChar::CHAR_CATEGORY_OTHER_NUMBER => true,
                    default => false,
                }
            ),
            static::encoding()->charIsLetterOrNumber(...),
        );
    }

    public function testCharIsLower(): void
    {
        static::assertChar(
            IntlChar::islower(...),
            static::encoding()->charIsLower(...),
        );
    }

    public function testCharIsMark(): void
    {
        static::assertChar(
            fn ($utf8Character) => (
                match (IntlChar::charType($utf8Character)) {
                    IntlChar::CHAR_CATEGORY_NON_SPACING_MARK,
                    IntlChar::CHAR_CATEGORY_ENCLOSING_MARK,
                    IntlChar::CHAR_CATEGORY_COMBINING_SPACING_MARK => true,
                    default => false,
                }
            ),
            static::encoding()->charIsMark(...),
        );
    }

    public function testCharIsNull(): void
    {
        static::assertChar(
            fn ($utf8Character) => (IntlChar::ord($utf8Character) === 0),
            static::encoding()->charIsNull(...),
        );
    }

    public function testCharIsNumber(): void
    {
        static::assertChar(
            fn ($utf8Character) => (
                match (IntlChar::charType($utf8Character)) {
                    IntlChar::CHAR_CATEGORY_DECIMAL_DIGIT_NUMBER,
                    IntlChar::CHAR_CATEGORY_LETTER_NUMBER,
                    IntlChar::CHAR_CATEGORY_OTHER_NUMBER => true,
                    default => false,
                }
            ),
            static::encoding()->charIsNumber(...),
        );
    }

    public function testCharIsPrintable(): void
    {
        static::assertChar(
            IntlChar::isprint(...),
            static::encoding()->charIsPrintable(...),
        );
    }

    public function testCharIsPunctuation(): void
    {
        static::assertChar(
            IntlChar::ispunct(...),
            static::encoding()->charIsPunctuation(...),
        );
    }

    public function testCharIsSeparator(): void
    {
        static::assertChar(
            fn ($utf8Character) => (
                match (IntlChar::charType($utf8Character)) {
                    IntlChar::CHAR_CATEGORY_SPACE_SEPARATOR,
                    IntlChar::CHAR_CATEGORY_LINE_SEPARATOR,
                    IntlChar::CHAR_CATEGORY_PARAGRAPH_SEPARATOR => true,
                    default => false,
                }
            ),
            static::encoding()->charIsSeparator(...),
        );
    }

    public function testCharIsSymbol(): void
    {
        static::assertChar(
            fn ($utf8Character) => (
                match (IntlChar::charType($utf8Character)) {
                    IntlChar::CHAR_CATEGORY_MATH_SYMBOL,
                    IntlChar::CHAR_CATEGORY_CURRENCY_SYMBOL,
                    IntlChar::CHAR_CATEGORY_MODIFIER_SYMBOL,
                    IntlChar::CHAR_CATEGORY_OTHER_SYMBOL => true,
                    default => false,
                }
            ),
            static::encoding()->charIsSymbol(...),
        );
    }

    public function testCharIsTitle(): void
    {
        static::assertChar(
            IntlChar::istitle(...),
            static::encoding()->charIsTitle(...),
        );
    }

    public function testCharIsUpper(): void
    {
        static::assertChar(
            IntlChar::isupper(...),
            static::encoding()->charIsUpper(...),
        );
    }

    public function testCharIsVisible(): void
    {
        static::assertChar(
            fn ($utf8Character) => (
                IntlChar::isprint($utf8Character)
                && !IntlChar::isspace($utf8Character)
            ),
            static::encoding()->charIsVisible(...),
        );
    }

    public function testCharIsWhitespace(): void
    {
        static::assertChar(
            IntlChar::isspace(...),
            static::encoding()->charIsWhitespace(...),
        );
    }

    /**
     * @return Generator<int>
     */
    public static function codepoints(): Generator
    {
        $encoding = static::encoding();

        $start = max($encoding->minCodepoint() - 3, 0);
        $end = $encoding->maxCodepoint() + 3;

        for ($code = $start; $code < $end; ++$code) {
            yield $code;
        }
    }

    public function testCodeCategory(): void
    {
        static::assertCode(
            Utf8::encoding()->charCategory(...),
            static::encoding()->codeCategory(...),
        );
    }

    public function testCodeDirection(): void
    {
        static::assertCode(
            Utf8::encoding()->charDirection(...),
            static::encoding()->codeDirection(...),
        );
    }

    public function testCodeName(): void
    {
        static::assertCode(
            Utf8::encoding()->charName(...),
            static::encoding()->codeName(...),
        );
    }

    public function testCodeScript(): void
    {
        static::assertCode(
            Utf8::encoding()->charScript(...),
            static::encoding()->codeScript(...),
        );
    }

    public function testCodeIsControl(): void
    {
        static::assertCode(
            fn ($utf8Character) => !IntlChar::isprint($utf8Character),
            static::encoding()->codeIsControl(...),
        );
    }

    public function testCodeIsDigit(): void
    {
        static::assertCode(
            IntlChar::isdigit(...),
            static::encoding()->codeIsDigit(...),
        );
    }

    public function testCodeIsLetter(): void
    {
        static::assertCode(
            IntlChar::isalpha(...),
            static::encoding()->codeIsLetter(...),
        );
    }

    public function testCodeIsLetterOrDigit(): void
    {
        static::assertCode(
            IntlChar::isalnum(...),
            static::encoding()->codeIsLetterOrDigit(...),
        );
    }

    public function testCodeIsLetterOrNumber(): void
    {
        static::assertCode(
            fn ($utf8Character) => (
                IntlChar::isalpha($utf8Character)
                || match (IntlChar::charType($utf8Character)) {
                    IntlChar::CHAR_CATEGORY_DECIMAL_DIGIT_NUMBER,
                    IntlChar::CHAR_CATEGORY_LETTER_NUMBER,
                    IntlChar::CHAR_CATEGORY_OTHER_NUMBER => true,
                    default => false,
                }
            ),
            static::encoding()->codeIsLetterOrNumber(...),
        );
    }

    public function testCodeIsLower(): void
    {
        static::assertCode(
            IntlChar::islower(...),
            static::encoding()->codeIsLower(...),
        );
    }

    public function testCodeIsMark(): void
    {
        static::assertCode(
            fn ($utf8Character) => (
                match (IntlChar::charType($utf8Character)) {
                    IntlChar::CHAR_CATEGORY_NON_SPACING_MARK,
                    IntlChar::CHAR_CATEGORY_ENCLOSING_MARK,
                    IntlChar::CHAR_CATEGORY_COMBINING_SPACING_MARK => true,
                    default => false,
                }
            ),
            static::encoding()->codeIsMark(...),
        );
    }

    public function testCodeIsNull(): void
    {
        static::assertCode(
            fn ($utf8Character) => (IntlChar::ord($utf8Character) === 0),
            static::encoding()->codeIsNull(...),
        );
    }

    public function testCodeIsNumber(): void
    {
        static::assertCode(
            fn ($utf8Character) => (
                match (IntlChar::charType($utf8Character)) {
                    IntlChar::CHAR_CATEGORY_DECIMAL_DIGIT_NUMBER,
                    IntlChar::CHAR_CATEGORY_LETTER_NUMBER,
                    IntlChar::CHAR_CATEGORY_OTHER_NUMBER => true,
                    default => false,
                }
            ),
            static::encoding()->codeIsNumber(...),
        );
    }

    public function testCodeIsPrintable(): void
    {
        static::assertCode(
            IntlChar::isprint(...),
            static::encoding()->codeIsPrintable(...),
        );
    }

    public function testCodeIsPunctuation(): void
    {
        static::assertCode(
            IntlChar::ispunct(...),
            static::encoding()->codeIsPunctuation(...),
        );
    }

    public function testCodeIsSeparator(): void
    {
        static::assertCode(
            fn ($utf8Character) => (
                match (IntlChar::charType($utf8Character)) {
                    IntlChar::CHAR_CATEGORY_SPACE_SEPARATOR,
                    IntlChar::CHAR_CATEGORY_LINE_SEPARATOR,
                    IntlChar::CHAR_CATEGORY_PARAGRAPH_SEPARATOR => true,
                    default => false,
                }
            ),
            static::encoding()->codeIsSeparator(...),
        );
    }

    public function testCodeIsSymbol(): void
    {
        static::assertCode(
            fn ($utf8Character) => (
                match (IntlChar::charType($utf8Character)) {
                    IntlChar::CHAR_CATEGORY_MATH_SYMBOL,
                    IntlChar::CHAR_CATEGORY_CURRENCY_SYMBOL,
                    IntlChar::CHAR_CATEGORY_MODIFIER_SYMBOL,
                    IntlChar::CHAR_CATEGORY_OTHER_SYMBOL => true,
                    default => false,
                }
            ),
            static::encoding()->codeIsSymbol(...),
        );
    }

    public function testCodeIsTitle(): void
    {
        static::assertCode(
            IntlChar::istitle(...),
            static::encoding()->codeIsTitle(...),
        );
    }

    public function testCodeIsUpper(): void
    {
        static::assertCode(
            IntlChar::isupper(...),
            static::encoding()->codeIsUpper(...),
        );
    }

    public function testCodeIsVisible(): void
    {
        static::assertCode(
            fn ($utf8Character) => (
                IntlChar::isprint($utf8Character)
                && !IntlChar::isspace($utf8Character)
            ),
            static::encoding()->codeIsVisible(...),
        );
    }

    public function testCodeIsWhitespace(): void
    {
        static::assertCode(
            IntlChar::isspace(...),
            static::encoding()->codeIsWhitespace(...),
        );
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

    /**
     * @param Closure(string):mixed $expected
     * @param Closure(int):mixed $actual
     *
     * @return void
     */
    protected static function assertCode(Closure $expected, Closure $actual): void
    {
        $encoding = static::encoding();

        foreach (static::codepoints() as $codepoint) {
            if ($encoding->codeIsValid($codepoint)) {
                $character = $encoding->char($codepoint);
                $utf8Character = static::convertToUtf8($character);

                $actualResult = $actual($codepoint);
                $expectedResult = $expected($utf8Character);

                static::assertSame(
                    $expectedResult,
                    $actualResult,
                    sprintf('Codepoint %02X (%s):', $codepoint, str_represent($character)),
                );
            } else {
                static::assertException(
                    new InvalidCodepoint($encoding, $codepoint),
                    fn () => $actual($codepoint),
                );
            }
        }
    }

    /**
     * @param Closure(string):mixed $expected
     * @param Closure(string):mixed $actual
     *
     * @return void
     */
    protected static function assertChar(Closure $expected, Closure $actual): void
    {
        $encoding = static::encoding();

        foreach (static::characters() as $character) {
            if ($encoding->charIsValid($character)) {
                $codepoint = $encoding->code($character);
                $utf8Character = static::convertToUtf8($character);

                $actualResult = $actual($character);
                $expectedResult = $expected($utf8Character);

                static::assertSame(
                    $expectedResult,
                    $actualResult,
                    sprintf('Codepoint %02X (%s):', $codepoint, str_represent($character)),
                );
            } else {
                static::assertException(
                    new InvalidCharacter($encoding, $character),
                    fn () => $actual($character),
                );
            }
        }
    }
}
