<?php

namespace Hereldar\CharacterEncodings\Traits;

use UnexpectedValueException;

trait IsSingleByte
{
    use IsFixedWidth;
    use IsSelfSynchronized;

    public function char(int $codepoint): string
    {
        if ($codepoint < $this->minCodepoint()) {
            throw new UnexpectedValueException();
        }

        if ($codepoint > $this->maxCodepoint()) {
            throw new UnexpectedValueException();
        }

        return chr($codepoint);
    }

    public function code(string $character): int
    {
        if (1 !== strlen($character)) {
            throw new UnexpectedValueException();
        }

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