<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings\Traits;

trait IsSingleByte
{
    use IsFixedWidth;
    use IsSelfSynchronized;

    public function char(int $codepoint): string
    {
        $this->codeCategory($codepoint);

        return chr($codepoint);
    }

    public function code(string $character): int
    {
        $this->charCategory($character);

        return ord($character);
    }

    public function isMultiByte(): bool
    {
        return false;
    }

    public function isSingleByte(): bool
    {
        return true;
    }

    public function width(): ?int
    {
        return 1;
    }
}
