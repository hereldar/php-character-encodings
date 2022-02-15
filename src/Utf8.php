<?php

namespace Hereldar\CharacterEncodings;

use Hereldar\CharacterEncodings\Traits\IsAsciiCompatible;
use Hereldar\CharacterEncodings\Traits\IsSelfSynchronized;
use Hereldar\CharacterEncodings\Traits\IsUnicode;
use Hereldar\CharacterEncodings\Traits\IsVariableWidth;

use IntlChar;
use UnexpectedValueException;

/**
 * @see https://en.wikipedia.org/wiki/Unicode
 * @see https://www.php.net/manual/en/class.intlchar.php
 * @see https://doc.qt.io/qt-6/qchar.html#public-types
 * @see https://doc.qt.io/qt-6/qstring.html#public-types
 */
class Utf8 extends AbstractEncoding
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
        $this->validateCode($codepoint);

        return IntlChar::chr($codepoint);
    }

    public function charCategory(string $character): int
    {
        $category = IntlChar::charType($character);

        if (!$category) {
            throw new UnexpectedValueException();
        }

        return $category;
    }

    public function charDirection(string $character): int
    {
        $direction = IntlChar::charDirection($character);

        if (!$direction) {
            throw new UnexpectedValueException();
        }

        return $direction;
    }

    public function charName(string $character): string
    {
        $name = IntlChar::charName($character);

        if (!$name) {
            throw new UnexpectedValueException();
        }

        return $name;
    }

    public function charScript(string $character): int
    {
        $script = IntlChar::getIntPropertyValue(
            $character,
            IntlChar::PROPERTY_SCRIPT
        );

        if (!$script) {
            throw new UnexpectedValueException();
        }

        return $script;
    }

    public function code(string $character): int
    {
        $codepoint = IntlChar::ord($character);

        if (!$codepoint) {
            throw new UnexpectedValueException();
        }

        return $codepoint;
    }

    public function codeCategory(int $codepoint): int
    {
        $this->validateCode($codepoint);

        return IntlChar::charType($codepoint);
    }

    public function codeDirection(int $codepoint): int
    {
        $this->validateCode($codepoint);

        return IntlChar::charDirection($codepoint);
    }

    public function codeName(int $codepoint): string
    {
        $this->validateCode($codepoint);

        return IntlChar::charName($codepoint);
    }

    public function codeScript(int $codepoint): int
    {
        $this->validateCode($codepoint);

        return IntlChar::getIntPropertyValue(
            $codepoint,
            IntlChar::PROPERTY_SCRIPT
        );
    }
}