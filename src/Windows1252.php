<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings;

use Generator;
use Hereldar\CharacterEncodings\Enums\Category;
use Hereldar\CharacterEncodings\Enums\Direction;
use Hereldar\CharacterEncodings\Enums\Script;
use Hereldar\CharacterEncodings\Exceptions\InvalidCharacter;
use Hereldar\CharacterEncodings\Exceptions\InvalidCodepoint;
use Hereldar\CharacterEncodings\Indexes\Windows1252CharCategories;
use Hereldar\CharacterEncodings\Indexes\Windows1252CharDirections;
use Hereldar\CharacterEncodings\Indexes\Windows1252CharNames;
use Hereldar\CharacterEncodings\Indexes\Windows1252CharScripts;
use Hereldar\CharacterEncodings\Indexes\Windows1252CodeCategories;
use Hereldar\CharacterEncodings\Indexes\Windows1252CodeDirections;
use Hereldar\CharacterEncodings\Indexes\Windows1252CodeNames;
use Hereldar\CharacterEncodings\Indexes\Windows1252CodeScripts;
use Hereldar\CharacterEncodings\Traits\IsAsciiCompatible;
use Hereldar\CharacterEncodings\Traits\IsFinal;
use Hereldar\CharacterEncodings\Traits\IsSingleByte;

/**
 * @see https://en.wikipedia.org/wiki/Windows-1252
 */
final class Windows1252 extends CharacterEncoding
{
    use IsAsciiCompatible;
    use IsFinal;
    use IsSingleByte;

    public const NAME = 'Windows-1252';
    public const WIDTH = 1;
    public const CODEPOINT_MAX = 255;
    public const CODEPOINT_MIN = 0;

    public function chars(): Generator
    {
        foreach (Windows1252CharCategories::INDEX as $character => $_) {
            yield (string) $character;
        }
    }

    public function codes(): Generator
    {
        foreach (Windows1252CodeCategories::INDEX as $codepoint => $_) {
            yield $codepoint;
        }
    }

    public function charCategory(string $character): Category
    {
        if (!isset(Windows1252CharCategories::INDEX[$character])) {
            throw new InvalidCharacter($this, $character);
        }

        return Windows1252CharCategories::INDEX[$character];
    }

    public function charDirection(string $character): Direction
    {
        if (!isset(Windows1252CharDirections::INDEX[$character])) {
            throw new InvalidCharacter($this, $character);
        }

        return Windows1252CharDirections::INDEX[$character];
    }

    public function charName(string $character): string
    {
        if (!isset(Windows1252CharNames::INDEX[$character])) {
            throw new InvalidCharacter($this, $character);
        }

        return Windows1252CharNames::INDEX[$character];
    }

    public function charScript(string $character): Script
    {
        if (!isset(Windows1252CharScripts::INDEX[$character])) {
            throw new InvalidCharacter($this, $character);
        }

        return Windows1252CharScripts::INDEX[$character];
    }

    public function codeCategory(int $codepoint): Category
    {
        if (!isset(Windows1252CodeCategories::INDEX[$codepoint])) {
            throw new InvalidCodepoint($this, $codepoint);
        }

        return Windows1252CodeCategories::INDEX[$codepoint];
    }

    public function codeDirection(int $codepoint): Direction
    {
        if (!isset(Windows1252CodeDirections::INDEX[$codepoint])) {
            throw new InvalidCodepoint($this, $codepoint);
        }

        return Windows1252CodeDirections::INDEX[$codepoint];
    }

    public function codeName(int $codepoint): string
    {
        if (!isset(Windows1252CodeNames::INDEX[$codepoint])) {
            throw new InvalidCodepoint($this, $codepoint);
        }

        return Windows1252CodeNames::INDEX[$codepoint];
    }

    public function codeScript(int $codepoint): Script
    {
        if (!isset(Windows1252CodeScripts::INDEX[$codepoint])) {
            throw new InvalidCodepoint($this, $codepoint);
        }

        return Windows1252CodeScripts::INDEX[$codepoint];
    }

    public function charIsValid(string $character): bool
    {
        return (strlen($character) === 1);
    }
}
