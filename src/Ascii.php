<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings;

use Generator;
use Hereldar\CharacterEncodings\Enums\Category;
use Hereldar\CharacterEncodings\Enums\Direction;
use Hereldar\CharacterEncodings\Enums\Script;
use Hereldar\CharacterEncodings\Exceptions\InvalidCharacter;
use Hereldar\CharacterEncodings\Exceptions\InvalidCodepoint;
use Hereldar\CharacterEncodings\Indexes\AsciiCharCategories;
use Hereldar\CharacterEncodings\Indexes\AsciiCharDirections;
use Hereldar\CharacterEncodings\Indexes\AsciiCharNames;
use Hereldar\CharacterEncodings\Indexes\AsciiCharScripts;
use Hereldar\CharacterEncodings\Indexes\AsciiCodeCategories;
use Hereldar\CharacterEncodings\Indexes\AsciiCodeDirections;
use Hereldar\CharacterEncodings\Indexes\AsciiCodeNames;
use Hereldar\CharacterEncodings\Indexes\AsciiCodeScripts;
use Hereldar\CharacterEncodings\Traits\IsAsciiCompatible;
use Hereldar\CharacterEncodings\Traits\IsSingleByte;

/**
 * @see https://en.wikipedia.org/wiki/ASCII
 */
class Ascii extends CharacterEncoding
{
    use IsAsciiCompatible;
    use IsSingleByte;

    public const NAME = 'ASCII';
    public const WIDTH = 1;
    public const CODEPOINT_MAX = 127;
    public const CODEPOINT_MIN = 0;

    public const CONTROL
        = "\x00\x01\x02\x03\x04\x05\x06\x07\x08\x09\x0A\x0B\x0C\x0D\x0E\x0F"
        . "\x10\x11\x12\x13\x14\x15\x16\x17\x18\x19\x1A\x1B\x1C\x1D\x1E\x1F"
        . "\x7F";

    // abcdefghijklmnopqrstuvwxyz
    public const LOWERCASE
        = "\x61\x62\x63\x64\x65\x66\x67\x68\x69\x6A\x6B\x6C\x6D\x6E\x6F"
        . "\x70\x71\x72\x73\x74\x75\x76\x77\x78\x79\x7A";

    // ABCDEFGHIJKLMNOPQRSTUVWXYZ
    public const UPPERCASE
        = "\x41\x42\x43\x44\x45\x46\x47\x48\x49\x4A\x4B\x4C\x4D\x4E\x4F"
        . "\x50\x51\x52\x53\x54\x55\x56\x57\x58\x59\x5A";

    public const LETTERS
        = self::LOWERCASE . self::UPPERCASE;

    // 0123456789
    public const DIGITS
        = "\x30\x31\x32\x33\x34\x35\x36\x37\x38\x39";

    // 0123456789abcedfABCDEF
    public const HEXDIGITS
        = "\x30\x31\x32\x33\x34\x35\x36\x37\x38\x39"
        . "\x61\x62\x63\x64\x65\x66"
        . "\x41\x42\x43\x44\x45\x46";

    // 01234567
    public const OCTDIGITS
        = "\x30\x31\x32\x33\x34\x35\x36\x37";

    public const NUMBERS
        = self::DIGITS;

    // !"#%&'()*,-./:;?@[\]_{}
    public const PUNCTUATION
        = "\x21\x22\x23\x25\x26\x27\x28\x29\x2A\x2C\x2D\x2E\x2F"
        . "\x3A\x3B\x3F\x40\x5B\x5C\x5D\x5F\x7B\x7D";

    // $+<=>^`|~
    public const SYMBOLS
        = "\x24\x2B\x3C\x3D\x3E\x5E\x60\x7C\x7E";

    // SP, HT, CR, LF, VT, FF, FS, GS, RS, US
    public const WHITESPACES
        = "\x20\x09\x0D\x0A\x0B\x0C\x1C\x1D\x1E\x1F";

    public const VISIBLE
        = self::LETTERS . self::NUMBERS . self::PUNCTUATION . self::SYMBOLS;

    public const PRINTABLE
        = self::VISIBLE . "\x20";

    public function chars(): Generator
    {
        foreach (AsciiCharCategories::INDEX as $character => $_) {
            yield (string) $character;
        }
    }

    public function codes(): Generator
    {
        foreach (AsciiCodeCategories::INDEX as $codepoint => $_) {
            yield $codepoint;
        }
    }

    public function charCategory(string $character): Category
    {
        if (!isset(AsciiCharCategories::INDEX[$character])) {
            throw new InvalidCharacter($this, $character);
        }

        return AsciiCharCategories::INDEX[$character];
    }

    public function charDirection(string $character): Direction
    {
        if (!isset(AsciiCharDirections::INDEX[$character])) {
            throw new InvalidCharacter($this, $character);
        }

        return AsciiCharDirections::INDEX[$character];
    }

    public function charIsControl(string $character): bool
    {
        return str_contains(static::CONTROL, $character);
    }

    public function charIsDigit(string $character): bool
    {
        return str_contains(static::DIGITS, $character);
    }

    public function charIsLetter(string $character): bool
    {
        return str_contains(static::LETTERS, $character);
    }

    public function charIsLetterOrNumber(string $character): bool
    {
        return str_contains(static::LETTERS, $character)
            || str_contains(static::NUMBERS, $character);
    }

    public function charIsLower(string $character): bool
    {
        return str_contains(static::LOWERCASE, $character);
    }

    public function charIsMark(string $character): bool
    {
        return false;
    }

    public function charIsNumber(string $character): bool
    {
        return str_contains(static::NUMBERS, $character);
    }

    public function charIsPrintable(string $character): bool
    {
        return str_contains(static::PRINTABLE, $character);
    }

    public function charIsPunctuation(string $character): bool
    {
        return str_contains(static::PUNCTUATION, $character);
    }

    public function charIsSeparator(string $character): bool
    {
        return ($character === ' ');
    }

    public function charIsSymbol(string $character): bool
    {
        return str_contains(static::SYMBOLS, $character);
    }

    public function charIsTitle(string $character): bool
    {
        return false;
    }

    public function charIsUpper(string $character): bool
    {
        return str_contains(static::UPPERCASE, $character);
    }

    public function charIsVisible(string $character): bool
    {
        return str_contains(static::VISIBLE, $character);
    }

    public function charIsWhitespace(string $character): bool
    {
        return str_contains(static::WHITESPACES, $character);
    }

    public function charName(string $character): string
    {
        if (!isset(AsciiCharNames::INDEX[$character])) {
            throw new InvalidCharacter($this, $character);
        }

        return AsciiCharNames::INDEX[$character];
    }

    public function charScript(string $character): Script
    {
        if (!isset(AsciiCharScripts::INDEX[$character])) {
            throw new InvalidCharacter($this, $character);
        }

        return AsciiCharScripts::INDEX[$character];
    }

    public function codeCategory(int $codepoint): Category
    {
        if (!isset(AsciiCodeCategories::INDEX[$codepoint])) {
            throw new InvalidCodepoint($this, $codepoint);
        }

        return AsciiCodeCategories::INDEX[$codepoint];
    }

    public function codeDirection(int $codepoint): Direction
    {
        if (!isset(AsciiCodeDirections::INDEX[$codepoint])) {
            throw new InvalidCodepoint($this, $codepoint);
        }

        return AsciiCodeDirections::INDEX[$codepoint];
    }

    public function codeName(int $codepoint): string
    {
        if (!isset(AsciiCodeNames::INDEX[$codepoint])) {
            throw new InvalidCodepoint($this, $codepoint);
        }

        return AsciiCodeNames::INDEX[$codepoint];
    }

    public function codeScript(int $codepoint): Script
    {
        if (!isset(AsciiCodeScripts::INDEX[$codepoint])) {
            throw new InvalidCodepoint($this, $codepoint);
        }

        return AsciiCodeScripts::INDEX[$codepoint];
    }
}
