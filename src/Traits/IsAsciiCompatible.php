<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings\Traits;

trait IsAsciiCompatible
{
    public function isAsciiCompatible(): bool
    {
        return true;
    }
}
