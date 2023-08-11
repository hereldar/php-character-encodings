<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings\Tests;

use Hereldar\CharacterEncodings\Windows1252;

final class Windows1252Test extends CharacterEncodingTestCase
{
    protected static function encoding(): Windows1252
    {
        return Windows1252::encoding();
    }
}
