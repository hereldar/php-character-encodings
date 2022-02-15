<?php

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