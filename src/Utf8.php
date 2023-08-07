<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings;

use Generator;
use Hereldar\CharacterEncodings\Exceptions\InvalidCharacter;
use Hereldar\CharacterEncodings\Exceptions\InvalidCodepoint;
use Hereldar\CharacterEncodings\Traits\IsAsciiCompatible;
use Hereldar\CharacterEncodings\Traits\IsSelfSynchronized;
use Hereldar\CharacterEncodings\Traits\IsUnicode;
use Hereldar\CharacterEncodings\Traits\IsVariableWidth;
use IntlChar;

/**
 * @see https://en.wikipedia.org/wiki/Unicode
 * @see https://www.php.net/manual/en/class.intlchar.php
 * @see https://doc.qt.io/qt-6/qchar.html#public-types
 * @see https://doc.qt.io/qt-6/qstring.html#public-types
 */
class Utf8 extends CharacterEncoding
{
    use IsAsciiCompatible;
    use IsSelfSynchronized;
    use IsUnicode;
    use IsVariableWidth;

    public const NAME = 'UTF-8';
    public const WIDTH = null;
    public const CODEPOINT_MAX = IntlChar::CODEPOINT_MAX;
    public const CODEPOINT_MIN = IntlChar::CODEPOINT_MIN;

    public const COMPATIBLE_ENCODINGS = [
        'UCS-4',
        'UCS-4BE',
        'UCS-4LE',
        'UCS-2',
        'UCS-2BE',
        'UCS-2LE',
        'UTF-32',
        'UTF-32BE',
        'UTF-32LE',
        'UTF-16',
        'UTF-16BE',
        'UTF-16LE',
        'UTF-8',
        'UTF-7',
        'UTF7-IMAP',
        'GB18030',
    ];

    public function char(int $codepoint): string
    {
        $character = IntlChar::chr($codepoint);

        if (null === $character) {
            throw new InvalidCodepoint($this, $codepoint);
        }

        return $character;
    }

    public function chars(): Generator
    {
        $start = $this->minCodepoint();
        $end = $this->maxCodepoint();

        for ($codepoint = $start; $codepoint < $end; ++$codepoint) {
            $character = IntlChar::chr($codepoint);
            if ($character !== null) {
                yield $character;
            }
        }
    }

    public function charCategory(string $character): int
    {
        $category = IntlChar::charType($character);

        if (null === $category) {
            throw new InvalidCharacter($this, $character);
        }

        return $category;
    }

    public function charDirection(string $character): int
    {
        $direction = IntlChar::charDirection($character);

        if (null === $direction) {
            throw new InvalidCharacter($this, $character);
        }

        return $direction;
    }

    public function charName(string $character): string
    {
        $name = IntlChar::charName($character);

        if (null === $name) {
            throw new InvalidCharacter($this, $character);
        }

        return $name;
    }

    public function charScript(string $character): int
    {
        $script = IntlChar::getIntPropertyValue(
            $character,
            IntlChar::PROPERTY_SCRIPT
        );

        if (null === $script) {
            throw new InvalidCharacter($this, $character);
        }

        return $script;
    }

    public function code(string $character): int
    {
        $codepoint = IntlChar::ord($character);

        if (null === $codepoint) {
            throw new InvalidCharacter($this, $character);
        }

        return $codepoint;
    }

    public function codes(): Generator
    {
        $start = $this->minCodepoint();
        $end = $this->maxCodepoint();

        for ($codepoint = $start; $codepoint < $end; ++$codepoint) {
            if (IntlChar::chr($codepoint) !== null) {
                yield $codepoint;
            }
        }
    }

    public function codeCategory(int $codepoint): int
    {
        $category = IntlChar::charType($codepoint);

        if (null === $category) {
            throw new InvalidCodepoint($this, $codepoint);
        }

        return $category;
    }

    public function codeDirection(int $codepoint): int
    {
        $direction = IntlChar::charDirection($codepoint);

        if (null === $direction) {
            throw new InvalidCodepoint($this, $codepoint);
        }

        return $direction;
    }

    public function codeName(int $codepoint): string
    {
        $name = IntlChar::charName($codepoint);

        if (null === $name) {
            throw new InvalidCodepoint($this, $codepoint);
        }

        return $name;
    }

    public function codeScript(int $codepoint): int
    {
        $script = IntlChar::getIntPropertyValue(
            $codepoint,
            IntlChar::PROPERTY_SCRIPT
        );

        if (null === $script) {
            throw new InvalidCodepoint($this, $codepoint);
        }

        return $script;
    }
}
