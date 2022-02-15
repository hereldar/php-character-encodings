<?php

namespace Hereldar\CharacterEncodings\Traits;

trait IsMultiByte
{
    public function isMultiByte(): bool
    {
        return true;
    }

    public function isSingleByte(): bool
    {
        return false;
    }
}