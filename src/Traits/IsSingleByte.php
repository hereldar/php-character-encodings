<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings\Traits;

use Hereldar\CharacterEncodings\Exceptions\InvalidCharacter;
use Hereldar\CharacterEncodings\Exceptions\InvalidCodepoint;

trait IsSingleByte
{
    use IsFixedWidth;
    use IsSelfSynchronized;

    public function char(int $codepoint): string
    {
        if (!$this->codeIsValid($codepoint)) {
            throw new InvalidCodepoint($this, $codepoint);
        }

        return chr($codepoint);
    }

    public function code(string $character): int
    {
        if (!$this->charIsValid($character)) {
            throw new InvalidCharacter($this, $character);
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

    public function charIsValid(string $character): bool
    {
        if (strlen($character) !== 1) {
            return false;
        }

        $codepoint = ord($character);

        return ($codepoint >= static::CODEPOINT_MIN)
            && ($codepoint <= static::CODEPOINT_MAX);
    }
}
