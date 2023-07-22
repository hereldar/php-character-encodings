<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings\Enums;

use IntlChar;

/**
 * @see https://en.wikipedia.org/wiki/Unicode_character_property#Bidirectional_writing
 * @see https://www.unicode.org/reports/tr9/#Bidirectional_Character_Types
 * @see https://doc.qt.io/qt-6/qchar.html#Direction-enum
 */
class Direction
{
    public const ARABIC_LETTER = IntlChar::CHAR_DIRECTION_RIGHT_TO_LEFT_ARABIC;
    public const ARABIC_NUMBER = IntlChar::CHAR_DIRECTION_ARABIC_NUMBER;
    public const BOUNDARY_NEUTRAL = IntlChar::CHAR_DIRECTION_BOUNDARY_NEUTRAL;
    public const COMMON_NUMBER_SEPARATOR = IntlChar::CHAR_DIRECTION_COMMON_NUMBER_SEPARATOR;
    public const EUROPEAN_NUMBER = IntlChar::CHAR_DIRECTION_EUROPEAN_NUMBER;
    public const EUROPEAN_NUMBER_SEPARATOR = IntlChar::CHAR_DIRECTION_EUROPEAN_NUMBER_SEPARATOR;
    public const EUROPEAN_NUMBER_TERMINATOR = IntlChar::CHAR_DIRECTION_EUROPEAN_NUMBER_TERMINATOR;
    public const FIRST_STRONG_ISOLATE = IntlChar::CHAR_DIRECTION_FIRST_STRONG_ISOLATE;
    public const LEFT_TO_RIGHT = IntlChar::CHAR_DIRECTION_LEFT_TO_RIGHT;
    public const LEFT_TO_RIGHT_EMBEDDING = IntlChar::CHAR_DIRECTION_LEFT_TO_RIGHT_EMBEDDING;
    public const LEFT_TO_RIGHT_ISOLATE = IntlChar::CHAR_DIRECTION_LEFT_TO_RIGHT_ISOLATE;
    public const LEFT_TO_RIGHT_OVERRIDE = IntlChar::CHAR_DIRECTION_LEFT_TO_RIGHT_OVERRIDE;
    public const NON_SPACING_MARK = IntlChar::CHAR_DIRECTION_DIR_NON_SPACING_MARK;
    public const OTHER_NEUTRAL = IntlChar::CHAR_DIRECTION_OTHER_NEUTRAL;
    public const PARAGRAPH_SEPARATOR = IntlChar::CHAR_DIRECTION_BLOCK_SEPARATOR;
    public const POP_DIRECTIONAL_FORMAT = IntlChar::CHAR_DIRECTION_POP_DIRECTIONAL_FORMAT;
    public const POP_DIRECTIONAL_ISOLATE = IntlChar::CHAR_DIRECTION_POP_DIRECTIONAL_ISOLATE;
    public const RIGHT_TO_LEFT = IntlChar::CHAR_DIRECTION_RIGHT_TO_LEFT;
    public const RIGHT_TO_LEFT_EMBEDDING = IntlChar::CHAR_DIRECTION_RIGHT_TO_LEFT_EMBEDDING;
    public const RIGHT_TO_LEFT_ISOLATE = IntlChar::CHAR_DIRECTION_RIGHT_TO_LEFT_ISOLATE;
    public const RIGHT_TO_LEFT_OVERRIDE = IntlChar::CHAR_DIRECTION_RIGHT_TO_LEFT_OVERRIDE;
    public const SEGMENT_SEPARATOR = IntlChar::CHAR_DIRECTION_SEGMENT_SEPARATOR;
    public const WHITE_SPACE = IntlChar::CHAR_DIRECTION_WHITE_SPACE_NEUTRAL;
}
