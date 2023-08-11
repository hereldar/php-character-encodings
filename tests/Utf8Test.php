<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings\Tests;

use Hereldar\CharacterEncodings\Utf8;

final class Utf8Test extends CharacterEncodingTestCase
{
    protected static function encoding(): Utf8
    {
        return Utf8::encoding();
    }
}
