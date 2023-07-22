<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings\Exceptions;

use Hereldar\CharacterEncodings\CharacterEncoding;
use UnexpectedValueException;

use function Hereldar\CharacterEncodings\str_represent;

final class InvalidCharacter extends UnexpectedValueException
{
    private const MESSAGE = "%s does not include the %s character";

    public function __construct(CharacterEncoding $encoding, string $character)
    {
        parent::__construct(
            sprintf(self::MESSAGE, $encoding->name(), str_represent($character))
        );
    }
}
