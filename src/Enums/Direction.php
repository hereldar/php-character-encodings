<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings\Enums;

/**
 * @see https://en.wikipedia.org/wiki/Unicode_character_property#Bidirectional_writing
 * @see https://www.unicode.org/reports/tr9/#Bidirectional_Character_Types
 * @see https://github.com/unicode-org/icu4x/blob/main/components/properties/src/props.rs#L671
 * @see https://doc.qt.io/qt-6/qchar.html#Direction-enum
 */
enum Direction: int
{
    use IntEnumValues;

    /** (`AL`) Any strong right-to-left (Arabic-type) character */
    case ArabicLetter = 13; // IntlChar::CHAR_DIRECTION_RIGHT_TO_LEFT_ARABIC;

    /** (`AN`) Any Arabic-Indic digit */
    case ArabicNumber = 5; // IntlChar::CHAR_DIRECTION_ARABIC_NUMBER;

    /** (`BN`) Most format characters, control codes, or non-characters */
    case BoundaryNeutral = 18; // IntlChar::CHAR_DIRECTION_BOUNDARY_NEUTRAL;

    /** (`CS`) Commas, colons, and slashes */
    case CommonNumberSeparator = 6; // IntlChar::CHAR_DIRECTION_COMMON_NUMBER_SEPARATOR;

    /** (`EN`) Any ASCII digit or Eastern Arabic-Indic digit */
    case EuropeanNumber = 2; // IntlChar::CHAR_DIRECTION_EUROPEAN_NUMBER;

    /** (`ES`) Plus and minus signs */
    case EuropeanNumberSeparator = 3; // IntlChar::CHAR_DIRECTION_EUROPEAN_NUMBER_SEPARATOR;

    /** (`ET`) A terminator in a numeric format context, includes currency signs */
    case EuropeanNumberTerminator = 4; // IntlChar::CHAR_DIRECTION_EUROPEAN_NUMBER_TERMINATOR;

    /** (`FSI`) U+2068: the first strong isolate control */
    case FirstStrongIsolate = 19; // IntlChar::CHAR_DIRECTION_FIRST_STRONG_ISOLATE;

    /** (`L`) Any strong left-to-right character */
    case LeftToRight = 0; // IntlChar::CHAR_DIRECTION_LEFT_TO_RIGHT;

    /** (`LRE`) U+202A: the LR embedding control */
    case LeftToRightEmbedding = 11; // IntlChar::CHAR_DIRECTION_LEFT_TO_RIGHT_EMBEDDING;

    /** (`LRI`) U+2066: the LR isolate control */
    case LeftToRightIsolate = 20; // IntlChar::CHAR_DIRECTION_LEFT_TO_RIGHT_ISOLATE;

    /** (`LRO`) U+202D: the LR override control */
    case LeftToRightOverride = 12; // IntlChar::CHAR_DIRECTION_LEFT_TO_RIGHT_OVERRIDE;

    /** (`NSM`) Any non-spacing mark */
    case NonSpacingMark = 17; // IntlChar::CHAR_DIRECTION_DIR_NON_SPACING_MARK;

    /** (`ON`) Most other symbols and punctuation marks */
    case OtherNeutral = 10; // IntlChar::CHAR_DIRECTION_OTHER_NEUTRAL;

    /** (`B`) Various newline characters */
    case ParagraphSeparator = 7; // IntlChar::CHAR_DIRECTION_BLOCK_SEPARATOR;

    /** (`PDF`) U+202C: terminates an embedding or override control */
    case PopDirectionalFormat = 16; // IntlChar::CHAR_DIRECTION_POP_DIRECTIONAL_FORMAT;

    /** (`PDI`) U+2069: terminates an isolate control */
    case PopDirectionalIsolate = 22; // IntlChar::CHAR_DIRECTION_POP_DIRECTIONAL_ISOLATE;

    /** (`R`) Any strong right-to-left (non-Arabic-type) character */
    case RightToLeft = 1; // IntlChar::CHAR_DIRECTION_RIGHT_TO_LEFT;

    /** (`RLE`) U+202B: the RL embedding control */
    case RightToLeftEmbedding = 14; // IntlChar::CHAR_DIRECTION_RIGHT_TO_LEFT_EMBEDDING;

    /** (`RLI`) U+2067: the RL isolate control */
    case RightToLeftIsolate = 21; // IntlChar::CHAR_DIRECTION_RIGHT_TO_LEFT_ISOLATE;

    /** (`RLO`) U+202E: the RL override control */
    case RightToLeftOverride = 15; // IntlChar::CHAR_DIRECTION_RIGHT_TO_LEFT_OVERRIDE;

    /** (`S`) Various segment-related control codes */
    case SegmentSeparator = 8; // IntlChar::CHAR_DIRECTION_SEGMENT_SEPARATOR;

    /** (`WS`) Spaces */
    case WhiteSpace = 9; // IntlChar::CHAR_DIRECTION_WHITE_SPACE_NEUTRAL;

    public function code(): string
    {
        return match ($this) {
            self::ArabicLetter => 'AL',
            self::ArabicNumber => 'AN',
            self::BoundaryNeutral => 'BN',
            self::CommonNumberSeparator => 'CS',
            self::EuropeanNumber => 'EN',
            self::EuropeanNumberSeparator => 'ES',
            self::EuropeanNumberTerminator => 'ET',
            self::FirstStrongIsolate => 'FSI',
            self::LeftToRight => 'L',
            self::LeftToRightEmbedding => 'LRE',
            self::LeftToRightIsolate => 'LRI',
            self::LeftToRightOverride => 'LRO',
            self::NonSpacingMark => 'NSM',
            self::OtherNeutral => 'ON',
            self::ParagraphSeparator => 'B',
            self::PopDirectionalFormat => 'PDF',
            self::PopDirectionalIsolate => 'PDI',
            self::RightToLeft => 'R',
            self::RightToLeftEmbedding => 'RLE',
            self::RightToLeftIsolate => 'RLI',
            self::RightToLeftOverride => 'RLO',
            self::SegmentSeparator => 'S',
            self::WhiteSpace => 'WS',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::ArabicLetter => 'Any strong right-to-left (Arabic-type) character',
            self::ArabicNumber => 'Any Arabic-Indic digit',
            self::BoundaryNeutral => 'Most format characters, control codes, or non-characters',
            self::CommonNumberSeparator => 'Commas, colons, and slashes',
            self::EuropeanNumber => 'Any ASCII digit or Eastern Arabic-Indic digit',
            self::EuropeanNumberSeparator => 'Plus and minus signs',
            self::EuropeanNumberTerminator => 'A terminator in a numeric format context, includes currency signs',
            self::FirstStrongIsolate => 'U+2068: the first strong isolate control',
            self::LeftToRight => 'Any strong left-to-right character',
            self::LeftToRightEmbedding => 'U+202A: the LR embedding control',
            self::LeftToRightIsolate => 'U+2066: the LR isolate control',
            self::LeftToRightOverride => 'U+202D: the LR override control',
            self::NonSpacingMark => 'Any non-spacing mark',
            self::OtherNeutral => 'Most other symbols and punctuation marks',
            self::ParagraphSeparator => 'Various newline characters',
            self::PopDirectionalFormat => 'U+202C: terminates an embedding or override control',
            self::PopDirectionalIsolate => 'U+2069: terminates an isolate control',
            self::RightToLeft => 'Any strong right-to-left (non-Arabic-type) character',
            self::RightToLeftEmbedding => 'U+202B: the RL embedding control',
            self::RightToLeftIsolate => 'U+2067: the RL isolate control',
            self::RightToLeftOverride => 'U+202E: the RL override control',
            self::SegmentSeparator => 'Various segment-related control codes',
            self::WhiteSpace => 'Spaces',
        };
    }
}
