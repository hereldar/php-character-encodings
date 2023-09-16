<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings\Tests;

use Generator;
use Hereldar\CharacterEncodings\Utf8;

final class Utf8Test extends CharacterEncodingTestCase
{
    public static function encoding(): Utf8
    {
        return Utf8::encoding();
    }

    public static function characters(): Generator
    {
        foreach (self::codepoints() as $codepoint) {
            if ($codepoint < 0x80) {
                yield chr($codepoint >> 0 & 0x7F | 0x00);
            } elseif ($codepoint < 0x0800) {
                yield chr($codepoint >> 6 & 0x1F | 0xC0)
                    . chr($codepoint >> 0 & 0x3F | 0x80);
            } elseif ($codepoint < 0x010000) {
                yield chr($codepoint >> 12 & 0x0F | 0xE0)
                    . chr($codepoint >> 6 & 0x3F | 0x80)
                    . chr($codepoint >> 0 & 0x3F | 0x80);
            } elseif ($codepoint < 0x110000) {
                yield chr($codepoint >> 18 & 0x07 | 0xF0)
                    . chr($codepoint >> 12 & 0x3F | 0x80)
                    . chr($codepoint >> 6 & 0x3F | 0x80)
                    . chr($codepoint >> 0 & 0x3F | 0x80);
            }
        }
    }
}
