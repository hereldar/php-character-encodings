<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings\Traits;

trait IsFixedWidth
{
    public function isFixedWidth(): bool
    {
        return true;
    }

    public function isVariableWidth(): bool
    {
        return false;
    }
}
