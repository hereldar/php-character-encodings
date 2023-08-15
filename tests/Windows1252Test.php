<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings\Tests;

use Generator;
use Hereldar\CharacterEncodings\Windows1252;

final class Windows1252Test extends CharacterEncodingTestCase
{
    public static function encoding(): Windows1252
    {
        return Windows1252::encoding();
    }

    public static function characters(): Generator
    {
        foreach (self::codepoints() as $codepoint) {
            yield chr($codepoint);
        }
    }
}
