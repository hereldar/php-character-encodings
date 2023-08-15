<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings\Tests;

use Generator;
use Hereldar\CharacterEncodings\Ascii;

final class AsciiTest extends CharacterEncodingTestCase
{
    public static function encoding(): Ascii
    {
        return Ascii::encoding();
    }

    public static function characters(): Generator
    {
        foreach (self::codepoints() as $codepoint) {
            yield chr($codepoint);
        }
    }
}
