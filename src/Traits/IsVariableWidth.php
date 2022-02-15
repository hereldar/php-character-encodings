<?php

namespace Hereldar\CharacterEncodings\Traits;

trait IsVariableWidth
{
    use IsMultiByte;

    public function isFixedWidth(): bool
    {
        return false;
    }

    public function isVariableWidth(): bool
    {
        return true;
    }

    public function width(): ?int
    {
        return null;
    }
}