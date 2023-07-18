<?php

namespace Hereldar\CharacterEncodings;

use Hereldar\CharacterEncodings\Indexes\Windows1252CharCategories;
use Hereldar\CharacterEncodings\Indexes\Windows1252CharDirections;
use Hereldar\CharacterEncodings\Indexes\Windows1252CharNames;
use Hereldar\CharacterEncodings\Indexes\Windows1252CharScripts;
use Hereldar\CharacterEncodings\Indexes\Windows1252CodeCategories;
use Hereldar\CharacterEncodings\Indexes\Windows1252CodeDirections;
use Hereldar\CharacterEncodings\Indexes\Windows1252CodeNames;
use Hereldar\CharacterEncodings\Indexes\Windows1252CodeScripts;
use Hereldar\CharacterEncodings\Traits\IsAsciiCompatible;
use Hereldar\CharacterEncodings\Traits\IsSingleByte;
use UnexpectedValueException;

/**
 * @see https://en.wikipedia.org/wiki/Windows-1252
 */
class Windows1252 extends CharacterEncoding
{
    use IsAsciiCompatible;
    use IsSingleByte;

    public const NAME = 'Windows-1252';
    public const WIDTH = 1;
    public const CODEPOINT_MAX = 255;
    public const CODEPOINT_MIN = 0;

    public const CONTROL
        = "\x00\x01\x02\x03\x04\x05\x06\x07\x08\x09\x0a\x0b\x0c\x0d\x0e\x0f"
        . "\x10\x11\x12\x13\x14\x15\x16\x17\x18\x19\x1a\x1b\x1c\x1d\x1e\x1f"
        . "\x7f"
        . "\x81\x8d\x8f\x90\x9d";

    public const LOWERCASE
        = "\x61\x62\x63\x64\x65\x66\x67\x68\x69\x6a\x6b\x6c\x6d\x6e\x6f"
        . "\x70\x71\x72\x73\x74\x75\x76\x77\x78\x79\x7a"
        . "\xe1\xe2\xe3\xe4\xe5\xe6\xe7\xe8\xe9\xea\xeb\xec\xed\xee\xef"
        . "\xf1\xf2\xf3\xf4\xf5\xf6\xf8\xf9\xfa\xfb\xfc\xfd\xfe\xff";

    public const UPPERCASE
        = "\x41\x42\x43\x44\x45\x46\x47\x48\x49\x4a\x4b\x4c\x4d\x4e\x4f"
        . "\x50\x51\x52\x53\x54\x55\x56\x57\x58\x59\x5a"
        . "\xc1\xc2\xc3\xc4\xc5\xc6\xc7\xc8\xc9\xca\xcb\xcc\xcd\xce\xcf"
        . "\xd1\xd2\xd3\xd4\xd5\xd6\xd8\xd9\xda\xdb\xdc\xdd\xde\xdf";

    public const LETTERS
        = self::LOWERCASE . self::UPPERCASE;

    public const DIGITS
        = "\x30\x31\x32\x33\x34\x35\x36\x37\x38\x39";

    public const HEXDIGITS
        = "\x30\x31\x32\x33\x34\x35\x36\x37\x38\x39"
        . "\x61\x62\x63\x64\x65\x66"
        . "\x41\x42\x43\x44\x45\x46";

    public const OCTDIGITS
        = "\x30\x31\x32\x33\x34\x35\x36\x37";

    public const NUMBERS
        = self::DIGITS
        . "\xb2\xb3\xb9\xbc\xbd\xbe";

    public const PUNCTUATION
        = "\x21\x22\x23\x25\x26\x27\x28\x29\x2a\x2c\x2d\x2e\x2f"
        . "\x3a\x3b\x3f\x40\x5b\x5c\x5d\x5f\x7b\x7d"
        . "\x82\x84\x85\x86\x87\x89\x8b\x91\x92\x93\x94\x95\x96\x97\x9b"
        . "\xa1\xa7\xab\xb6\xb7\xbb\xbf";

    public const SYMBOLS
        = "\x24\x2b\x3c\x3d\x3e\x5e\x60\x7c\x7e"
        . "\x80\x98\x99\xa2\xa3\xa4\xa5\xa6\xa8\xa9\xac\xae\xaf\xb0\xb1"
        . "\xb4\xb8\xd7\xf7";

    public const WHITESPACES = " \t\r\n\v\f";

    public const VISIBLE = self::LETTERS . self::NUMBERS . self::PUNCTUATION . self::SYMBOLS;
    public const PRINTABLE = self::VISIBLE . self::WHITESPACES;

    public function charCategory(string $character): int
    {
        if (!isset(Windows1252CharCategories::INDEX[$character])) {
            throw new UnexpectedValueException();
        }

        return Windows1252CharCategories::INDEX[$character];
    }

    public function charDirection(string $character): int
    {
        if (!isset(Windows1252CharDirections::INDEX[$character])) {
            throw new UnexpectedValueException();
        }

        return Windows1252CharDirections::INDEX[$character];
    }

    public function charIsWhitespace(string $character): bool
    {
        return str_contains($character, static::WHITESPACES);
    }

    public function charName(string $character): string
    {
        if (!isset(Windows1252CharNames::INDEX[$character])) {
            throw new UnexpectedValueException();
        }

        return Windows1252CharNames::INDEX[$character];
    }

    public function charScript(string $character): int
    {
        if (!isset(Windows1252CharScripts::INDEX[$character])) {
            throw new UnexpectedValueException();
        }

        return Windows1252CharScripts::INDEX[$character];
    }

    public function codeCategory(int $codepoint): int
    {
        if (!isset(Windows1252CodeCategories::INDEX[$codepoint])) {
            throw new UnexpectedValueException();
        }

        return Windows1252CodeCategories::INDEX[$codepoint];
    }

    public function codeDirection(int $codepoint): int
    {
        if (!isset(Windows1252CodeDirections::INDEX[$codepoint])) {
            throw new UnexpectedValueException();
        }

        return Windows1252CodeDirections::INDEX[$codepoint];
    }

    public function codeIsWhitespace(int $codepoint): bool
    {
        return $this->charIsWhitespace($this->char($codepoint));
    }

    public function codeName(int $codepoint): string
    {
        if (!isset(Windows1252CodeNames::INDEX[$codepoint])) {
            throw new UnexpectedValueException();
        }

        return Windows1252CodeNames::INDEX[$codepoint];
    }

    public function codeScript(int $codepoint): int
    {
        if (!isset(Windows1252CodeScripts::INDEX[$codepoint])) {
            throw new UnexpectedValueException();
        }

        return Windows1252CodeScripts::INDEX[$codepoint];
    }
}
