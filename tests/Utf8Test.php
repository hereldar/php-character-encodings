<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings\Tests;

use Generator;
use Hereldar\CharacterEncodings\Utf8;
use IntlChar;

final class Utf8Test extends CharacterEncodingTestCase
{
    public static function encoding(): Utf8
    {
        return Utf8::encoding();
    }

    public static function characters(): Generator
    {
        foreach (self::codepoints() as $codepoint) {
            yield IntlChar::chr($codepoint);
        }
    }
}
