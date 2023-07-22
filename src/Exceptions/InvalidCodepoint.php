<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings\Exceptions;

use Hereldar\CharacterEncodings\CharacterEncoding;
use UnexpectedValueException;

final class InvalidCodepoint extends UnexpectedValueException
{
    private const OUT_OF_BOUND_MESSAGE = "%s uses code points between %X and %X, %X given";
    private const UNUSED_MESSAGE = "%s does not use the %X code point";

    public function __construct(CharacterEncoding $encoding, int $codepoint)
    {
        parent::__construct(
            ($codepoint < $encoding->minCodepoint() || $codepoint > $encoding->maxCodepoint())
                ? sprintf(self::OUT_OF_BOUND_MESSAGE, $encoding->name(), $encoding->minCodepoint(), $encoding->maxCodepoint(), $codepoint)
                : sprintf(self::UNUSED_MESSAGE, $encoding->name(), $codepoint)
        );
    }
}
