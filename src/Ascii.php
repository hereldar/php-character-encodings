<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings;

use Generator;
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
        = "\x00\x01\x02\x03\x04\x05\x06\x07\x08\x09\x0a\x0b\x0c\x0d\x0e\x0f"
        . "\x10\x11\x12\x13\x14\x15\x16\x17\x18\x19\x1a\x1b\x1c\x1d\x1e\x1f"
        . "\x7f";

    // abcdefghijklmnopqrstuvwxyz
    public const LOWERCASE
        = "\x61\x62\x63\x64\x65\x66\x67\x68\x69\x6a\x6b\x6c\x6d\x6e\x6f"
        . "\x70\x71\x72\x73\x74\x75\x76\x77\x78\x79\x7a";

    // ABCDEFGHIJKLMNOPQRSTUVWXYZ
    public const UPPERCASE
        = "\x41\x42\x43\x44\x45\x46\x47\x48\x49\x4a\x4b\x4c\x4d\x4e\x4f"
        . "\x50\x51\x52\x53\x54\x55\x56\x57\x58\x59\x5a";

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
        = "\x21\x22\x23\x25\x26\x27\x28\x29\x2a\x2c\x2d\x2e\x2f"
        . "\x3a\x3b\x3f\x40\x5b\x5c\x5d\x5f\x7b\x7d";

    // $+<=>^`|~
    public const SYMBOLS
        = "\x24\x2b\x3c\x3d\x3e\x5e\x60\x7c\x7e";

    public const WHITESPACES
        = " \t\r\n\v\f";

    public const VISIBLE
        = self::LETTERS . self::NUMBERS . self::PUNCTUATION . self::SYMBOLS;

    public const PRINTABLE
        = self::VISIBLE . self::WHITESPACES;

    public function chars(): Generator
    {
        foreach (AsciiCharCategories::INDEX as $character => $category) {
            yield (string) $character;
        }
    }

    public function codes(): Generator
    {
        foreach (AsciiCodeCategories::INDEX as $codepoint => $category) {
            yield $codepoint;
        }
    }

    public function charCategory(string $character): int
    {
        if (!isset(AsciiCharCategories::INDEX[$character])) {
            throw new InvalidCharacter($this, $character);
        }

        return AsciiCharCategories::INDEX[$character];
    }

    public function charDirection(string $character): int
    {
        if (!isset(AsciiCharDirections::INDEX[$character])) {
            throw new InvalidCharacter($this, $character);
        }

        return AsciiCharDirections::INDEX[$character];
    }

    public function charIsWhitespace(string $character): bool
    {
        return str_contains($character, static::WHITESPACES);
    }

    public function charName(string $character): string
    {
        if (!isset(AsciiCharNames::INDEX[$character])) {
            throw new InvalidCharacter($this, $character);
        }

        return AsciiCharNames::INDEX[$character];
    }

    public function charScript(string $character): int
    {
        if (!isset(AsciiCharScripts::INDEX[$character])) {
            throw new InvalidCharacter($this, $character);
        }

        return AsciiCharScripts::INDEX[$character];
    }

    public function codeCategory(int $codepoint): int
    {
        if (!isset(AsciiCodeCategories::INDEX[$codepoint])) {
            throw new InvalidCodepoint($this, $codepoint);
        }

        return AsciiCodeCategories::INDEX[$codepoint];
    }

    public function codeDirection(int $codepoint): int
    {
        if (!isset(AsciiCodeDirections::INDEX[$codepoint])) {
            throw new InvalidCodepoint($this, $codepoint);
        }

        return AsciiCodeDirections::INDEX[$codepoint];
    }

    public function codeIsWhitespace(int $codepoint): bool
    {
        return $this->charIsWhitespace($this->char($codepoint));
    }

    public function codeName(int $codepoint): string
    {
        if (!isset(AsciiCodeNames::INDEX[$codepoint])) {
            throw new InvalidCodepoint($this, $codepoint);
        }

        return AsciiCodeNames::INDEX[$codepoint];
    }

    public function codeScript(int $codepoint): int
    {
        if (!isset(AsciiCodeScripts::INDEX[$codepoint])) {
            throw new InvalidCodepoint($this, $codepoint);
        }

        return AsciiCodeScripts::INDEX[$codepoint];
    }
}
