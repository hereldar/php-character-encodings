<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings\Traits;

use Hereldar\CharacterEncodings\Ascii;

trait IsAsciiCompatible
{
    public function isAsciiCompatible(): bool
    {
        return true;
    }

    public function charIsAscii(string $character): bool
    {
        if (strlen($character) !== 1) {
            return false;
        }

        return (ord($character) <= Ascii::CODEPOINT_MAX);
    }

    public function codeIsAscii(int $codepoint): bool
    {
        return ($codepoint <= Ascii::CODEPOINT_MAX);
    }
}
