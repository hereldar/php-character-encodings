<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings\Tests;

use Hereldar\CharacterEncodings\Ascii;

final class AsciiTest extends CharacterEncodingTestCase
{
    protected static function encoding(): Ascii
    {
        return Ascii::encoding();
    }
}
