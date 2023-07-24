<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings\Tests;

use Hereldar\CharacterEncodings\Ascii;

final class AsciiTest extends TestCase
{
    protected static function encoding(): Ascii
    {
        return Ascii::encoding();
    }
}
