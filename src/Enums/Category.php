<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings\Enums;

use IntlChar;

/**
 * @see https://en.wikipedia.org/wiki/Unicode_character_property#General_Category
 * @see https://doc.qt.io/qt-6/qchar.html#Category-enum
 */
class Category
{
    public const UPPERCASE_LETTER = IntlChar::CHAR_CATEGORY_UPPERCASE_LETTER;
    public const LOWERCASE_LETTER = IntlChar::CHAR_CATEGORY_LOWERCASE_LETTER;
    public const TITLECASE_LETTER = IntlChar::CHAR_CATEGORY_TITLECASE_LETTER;
    public const MODIFIER_LETTER = IntlChar::CHAR_CATEGORY_MODIFIER_LETTER;
    public const OTHER_LETTER = IntlChar::CHAR_CATEGORY_OTHER_LETTER;
    public const NON_SPACING_MARK = IntlChar::CHAR_CATEGORY_NON_SPACING_MARK;
    public const COMBINING_SPACING_MARK = IntlChar::CHAR_CATEGORY_COMBINING_SPACING_MARK;
    public const ENCLOSING_MARK = IntlChar::CHAR_CATEGORY_ENCLOSING_MARK;
    public const DECIMAL_DIGIT_NUMBER = IntlChar::CHAR_CATEGORY_DECIMAL_DIGIT_NUMBER;
    public const LETTER_NUMBER = IntlChar::CHAR_CATEGORY_LETTER_NUMBER;
    public const OTHER_NUMBER = IntlChar::CHAR_CATEGORY_OTHER_NUMBER;
    public const CONNECTOR_PUNCTUATION = IntlChar::CHAR_CATEGORY_CONNECTOR_PUNCTUATION;
    public const DASH_PUNCTUATION = IntlChar::CHAR_CATEGORY_DASH_PUNCTUATION;
    public const OPEN_PUNCTUATION = IntlChar::CHAR_CATEGORY_START_PUNCTUATION;
    public const CLOSE_PUNCTUATION = IntlChar::CHAR_CATEGORY_END_PUNCTUATION;
    public const INITIAL_QUOTE_PUNCTUATION = IntlChar::CHAR_CATEGORY_INITIAL_PUNCTUATION;
    public const FINAL_QUOTE_PUNCTUATION = IntlChar::CHAR_CATEGORY_FINAL_PUNCTUATION;
    public const OTHER_PUNCTUATION = IntlChar::CHAR_CATEGORY_OTHER_PUNCTUATION;
    public const MATH_SYMBOL = IntlChar::CHAR_CATEGORY_MATH_SYMBOL;
    public const CURRENCY_SYMBOL = IntlChar::CHAR_CATEGORY_CURRENCY_SYMBOL;
    public const MODIFIER_SYMBOL = IntlChar::CHAR_CATEGORY_MODIFIER_SYMBOL;
    public const OTHER_SYMBOL = IntlChar::CHAR_CATEGORY_OTHER_SYMBOL;
    public const SPACE_SEPARATOR = IntlChar::CHAR_CATEGORY_SPACE_SEPARATOR;
    public const LINE_SEPARATOR = IntlChar::CHAR_CATEGORY_LINE_SEPARATOR;
    public const PARAGRAPH_SEPARATOR = IntlChar::CHAR_CATEGORY_PARAGRAPH_SEPARATOR;
    public const CONTROL_CHAR = IntlChar::CHAR_CATEGORY_CONTROL_CHAR;
    public const FORMAT_CHAR = IntlChar::CHAR_CATEGORY_FORMAT_CHAR;
    public const SURROGATE_CHAR = IntlChar::CHAR_CATEGORY_SURROGATE;
    public const PRIVATE_USE_CHAR = IntlChar::CHAR_CATEGORY_PRIVATE_USE_CHAR;
    public const NOT_ASSIGNED_CHAR = IntlChar::CHAR_CATEGORY_UNASSIGNED;
}
