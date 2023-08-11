<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings\Enums;

use IntlChar;

/**
 * @see https://en.wikipedia.org/wiki/Unicode_character_property#General_Category
 * @see https://github.com/unicode-org/icu4x/blob/main/components/properties/src/props.rs#L945
 * @see https://doc.qt.io/qt-6/qchar.html#Category-enum
 */
enum CategoryGroup
{
    /** (`L`) The union of all letter categories */
    case Letter;

    /** (`LC`) The union of the cased letter categories */
    case CasedLetter;

    /** (`M`) The union of all mark categories */
    case Mark;

    /** (`N`) The union of all number categories */
    case Number;

    /** (`P`) The union of all punctuation categories */
    case Punctuation;

    /** (`S`) The union of all symbol categories */
    case Symbol;

    /** (`Z`) The union of all separator categories */
    case Separator;

    /** (`C`) The union of all control code, reserved, and unassigned categories */
    case Other;

    public function code(): string
    {
        return match ($this) {
            self::Letter => 'L',
            self::CasedLetter => 'LC',
            self::Mark => 'M',
            self::Number => 'N',
            self::Punctuation => 'P',
            self::Symbol => 'S',
            self::Separator => 'Z',
            self::Other => 'C',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::Letter => 'The union of all letter categories',
            self::CasedLetter => 'The union of the cased letter categories',
            self::Mark => 'The union of all mark categories',
            self::Number => 'The union of all number categories',
            self::Punctuation => 'The union of all punctuation categories',
            self::Symbol => 'The union of all symbol categories',
            self::Separator => 'The union of all separator categories',
            self::Other => 'The union of all control code, reserved, and unassigned categories',
        };
    }
}
