<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings\Enums;

use IntlChar;

/**
 * @see https://en.wikipedia.org/wiki/Unicode_character_property#General_Category
 * @see https://github.com/unicode-org/icu4x/blob/main/components/properties/src/props.rs#L790
 * @see https://doc.qt.io/qt-6/qchar.html#Category-enum
 */
enum Category: int
{
    use IntEnumValues;

    /** (`Lu`) An uppercase letter */
    case UppercaseLetter = IntlChar::CHAR_CATEGORY_UPPERCASE_LETTER;

    /** (`Ll`) A lowercase letter */
    case LowercaseLetter = IntlChar::CHAR_CATEGORY_LOWERCASE_LETTER;

    /** (`Lt`) A digraphic letter, with first part uppercase (e.g., ǅ, ǈ, ǋ, and ǲ) */
    case TitlecaseLetter = IntlChar::CHAR_CATEGORY_TITLECASE_LETTER;

    /** (`Lm`) A modifier letter */
    case ModifierLetter = IntlChar::CHAR_CATEGORY_MODIFIER_LETTER;

    /** (`Lo`) An ideograph or a letter in a unicase alphabet */
    case OtherLetter = IntlChar::CHAR_CATEGORY_OTHER_LETTER;

    /** (`Mn`) A non-spacing combining mark (zero advance width) */
    case NonSpacingMark = IntlChar::CHAR_CATEGORY_NON_SPACING_MARK;

    /** (`Mc`) A spacing combining mark (positive advance width) */
    case CombiningSpacingMark = IntlChar::CHAR_CATEGORY_COMBINING_SPACING_MARK;

    /** (`Me`) An enclosing combining mark */
    case EnclosingMark = IntlChar::CHAR_CATEGORY_ENCLOSING_MARK;

    /** (`Nd`) A decimal digit */
    case DecimalDigitNumber = IntlChar::CHAR_CATEGORY_DECIMAL_DIGIT_NUMBER;

    /** (`Nl`) A letter-like numeric character (e.g., Roman numerals) */
    case LetterNumber = IntlChar::CHAR_CATEGORY_LETTER_NUMBER;

    /** (`No`) A numeric character of other type (e.g., vulgar fractions, superscript and subscript digits) */
    case OtherNumber = IntlChar::CHAR_CATEGORY_OTHER_NUMBER;

    /** (`Pc`) A connecting punctuation mark, like a tie or an underscore */
    case ConnectorPunctuation = IntlChar::CHAR_CATEGORY_CONNECTOR_PUNCTUATION;

    /** (`Pd`) A dash or hyphen punctuation mark */
    case DashPunctuation = IntlChar::CHAR_CATEGORY_DASH_PUNCTUATION;

    /** (`Ps`) An opening punctuation mark (of a pair) */
    case OpenPunctuation = IntlChar::CHAR_CATEGORY_START_PUNCTUATION;

    /** (`Pe`) A closing punctuation mark (of a pair) */
    case ClosePunctuation = IntlChar::CHAR_CATEGORY_END_PUNCTUATION;

    /** (`Pi`) An initial quotation mark */
    case InitialQuotePunctuation = IntlChar::CHAR_CATEGORY_INITIAL_PUNCTUATION;

    /** (`Pf`) A final quotation mark */
    case FinalQuotePunctuation = IntlChar::CHAR_CATEGORY_FINAL_PUNCTUATION;

    /** (`Po`) A punctuation mark of other type */
    case OtherPunctuation = IntlChar::CHAR_CATEGORY_OTHER_PUNCTUATION;

    /** (`Sm`) A symbol of mathematical use (e.g., +, −, =, ×, ÷, √, ∊, ≠) */
    case MathSymbol = IntlChar::CHAR_CATEGORY_MATH_SYMBOL;

    /** (`Sc`) A currency symbol */
    case CurrencySymbol = IntlChar::CHAR_CATEGORY_CURRENCY_SYMBOL;

    /** (`Sk`) A non-letter-like modifier symbol */
    case ModifierSymbol = IntlChar::CHAR_CATEGORY_MODIFIER_SYMBOL;

    /** (`So`) A symbol of other type */
    case OtherSymbol = IntlChar::CHAR_CATEGORY_OTHER_SYMBOL;

    /** (`Zs`) A space character (of various non-zero widths) */
    case SpaceSeparator = IntlChar::CHAR_CATEGORY_SPACE_SEPARATOR;

    /** (`Zl`) U+2028 LINE SEPARATOR only */
    case LineSeparator = IntlChar::CHAR_CATEGORY_LINE_SEPARATOR;

    /** (`Zp`) U+2029 PARAGRAPH SEPARATOR only */
    case ParagraphSeparator = IntlChar::CHAR_CATEGORY_PARAGRAPH_SEPARATOR;

    /** (`Cc`) A C0 or C1 control code */
    case ControlChar = IntlChar::CHAR_CATEGORY_CONTROL_CHAR;

    /** (`Cf`) A format control character */
    case FormatChar = IntlChar::CHAR_CATEGORY_FORMAT_CHAR;

    /** (`Cs`) A surrogate code point */
    case SurrogateChar = IntlChar::CHAR_CATEGORY_SURROGATE;

    /** (`Co`) A private-use character */
    case PrivateUseChar = IntlChar::CHAR_CATEGORY_PRIVATE_USE_CHAR;

    /** (`Cn`) A reserved unassigned code point or a non-character */
    case NotAssignedChar = IntlChar::CHAR_CATEGORY_UNASSIGNED;

    public function code(): string
    {
        return match ($this) {
            self::UppercaseLetter => 'Lu',
            self::LowercaseLetter => 'Ll',
            self::TitlecaseLetter => 'Lt',
            self::ModifierLetter => 'Lm',
            self::OtherLetter => 'Lo',
            self::NonSpacingMark => 'Mn',
            self::CombiningSpacingMark => 'Mc',
            self::EnclosingMark => 'Me',
            self::DecimalDigitNumber => 'Nd',
            self::LetterNumber => 'Nl',
            self::OtherNumber => 'No',
            self::ConnectorPunctuation => 'Pc',
            self::DashPunctuation => 'Pd',
            self::OpenPunctuation => 'Ps',
            self::ClosePunctuation => 'Pe',
            self::InitialQuotePunctuation => 'Pi',
            self::FinalQuotePunctuation => 'Pf',
            self::OtherPunctuation => 'Po',
            self::MathSymbol => 'Sm',
            self::CurrencySymbol => 'Sc',
            self::ModifierSymbol => 'Sk',
            self::OtherSymbol => 'So',
            self::SpaceSeparator => 'Zs',
            self::LineSeparator => 'Zl',
            self::ParagraphSeparator => 'Zp',
            self::ControlChar => 'Cc',
            self::FormatChar => 'Cf',
            self::SurrogateChar => 'Cs',
            self::PrivateUseChar => 'Co',
            self::NotAssignedChar => 'Cn',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::UppercaseLetter => 'An uppercase letter',
            self::LowercaseLetter => 'A lowercase letter',
            self::TitlecaseLetter => 'A digraphic letter, with first part uppercase (e.g., ǅ, ǈ, ǋ, and ǲ)',
            self::ModifierLetter => 'A modifier letter',
            self::OtherLetter => 'An ideograph or a letter in a unicase alphabet',
            self::NonSpacingMark => 'A non-spacing combining mark (zero advance width)',
            self::CombiningSpacingMark => 'A spacing combining mark (positive advance width)',
            self::EnclosingMark => 'An enclosing combining mark',
            self::DecimalDigitNumber => 'A decimal digit',
            self::LetterNumber => 'A letter-like numeric character (e.g., Roman numerals)',
            self::OtherNumber => 'A numeric character of other type (e.g., vulgar fractions, superscript and subscript digits)',
            self::ConnectorPunctuation => 'A connecting punctuation mark, like a tie or an underscore',
            self::DashPunctuation => 'A dash or hyphen punctuation mark',
            self::OpenPunctuation => 'An opening punctuation mark (of a pair)',
            self::ClosePunctuation => 'A closing punctuation mark (of a pair)',
            self::InitialQuotePunctuation => 'An initial quotation mark',
            self::FinalQuotePunctuation => 'A final quotation mark',
            self::OtherPunctuation => 'A punctuation mark of other type',
            self::MathSymbol => 'A symbol of mathematical use (e.g., +, −, =, ×, ÷, √, ∊, ≠)',
            self::CurrencySymbol => 'A currency symbol',
            self::ModifierSymbol => 'A non-letter-like modifier symbol',
            self::OtherSymbol => 'A symbol of other type',
            self::SpaceSeparator => 'A space character (of various non-zero widths)',
            self::LineSeparator => 'U+2028 LINE SEPARATOR only',
            self::ParagraphSeparator => 'U+2029 PARAGRAPH SEPARATOR only',
            self::ControlChar => 'A C0 or C1 control code',
            self::FormatChar => 'A format control character',
            self::SurrogateChar => 'A surrogate code point',
            self::PrivateUseChar => 'A private-use character',
            self::NotAssignedChar => 'A reserved unassigned code point or a non-character',
        };
    }

    public function group(): CategoryGroup
    {
        return match ($this) {
            self::UppercaseLetter,
            self::LowercaseLetter,
            self::TitlecaseLetter,
            self::ModifierLetter,
            self::OtherLetter => CategoryGroup::Letter,
            self::NonSpacingMark,
            self::CombiningSpacingMark,
            self::EnclosingMark => CategoryGroup::Mark,
            self::DecimalDigitNumber,
            self::LetterNumber,
            self::OtherNumber => CategoryGroup::Number,
            self::ConnectorPunctuation,
            self::DashPunctuation,
            self::OpenPunctuation,
            self::ClosePunctuation,
            self::InitialQuotePunctuation,
            self::FinalQuotePunctuation,
            self::OtherPunctuation => CategoryGroup::Punctuation,
            self::MathSymbol,
            self::CurrencySymbol,
            self::ModifierSymbol,
            self::OtherSymbol => CategoryGroup::Symbol,
            self::SpaceSeparator,
            self::LineSeparator,
            self::ParagraphSeparator => CategoryGroup::Separator,
            self::ControlChar,
            self::FormatChar,
            self::SurrogateChar,
            self::PrivateUseChar,
            self::NotAssignedChar => CategoryGroup::Other,
        };
    }
}
