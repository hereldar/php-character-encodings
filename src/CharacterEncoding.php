<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings;

use Hereldar\CharacterEncodings\Enums\Category;
use UnexpectedValueException;

/**
 * @psalm-consistent-constructor
 *
 * @see https://encoding.spec.whatwg.org/
 * @see https://en.wikipedia.org/wiki/Unicode_character_property
 * @see https://www.php.net/manual/en/class.intlchar.php
 * @see https://doc.qt.io/qt-6/qchar.html
 */
abstract class CharacterEncoding
{
    private static array $instances = [];

    private function __construct()
    {
    }

    public function __toString(): string
    {
        return $this->name();
    }

    public static function encoding(): static
    {
        $class = static::class;

        if (isset(self::$instances[$class])) {
            return self::$instances[$class];
        }

        return self::$instances[$class] = new static();
    }

    /**
     * Returns `true` if the encoding includes the standard seven-bit
     * ASCII characters; otherwise returns `false`.
     */
    public function isAsciiCompatible(): bool
    {
        return false;
    }

    /**
     * Returns `true` if the encoding uses a fixed number of bytes to
     * encode its characters; otherwise returns `false`.
     */
    public function isFixedWidth(): bool
    {
        return !$this->isVariableWidth();
    }

    /**
     * Returns `true` if the encoding uses more than one byte to
     * encode a single character; otherwise returns `false`.
     */
    public function isMultiByte(): bool
    {
        return !$this->isSingleByte();
    }

    /**
     * Returns `true` if a part of any codeword in the encoding, or
     * the overlapping part of any two adjacent codewords, is not a
     * valid codeword; otherwise returns `false`.
     */
    public function isSelfSynchronized(): bool
    {
        return $this->isSingleByte();
    }

    /**
     * Returns `true` if the encoding uses a single byte to encode all
     * its characters; otherwise returns `false`.
     */
    public function isSingleByte(): bool
    {
        return false;
    }

    /**
     * Returns `true` if the encoding is capable of encoding all valid
     * character code points in Unicode; otherwise returns `false`.
     */
    public function isUnicode(): bool
    {
        return false;
    }

    /**
     * Returns `true` if the encoding uses varying numbers of bytes
     * to encode different characters; otherwise returns `false`.
     */
    public function isVariableWidth(): bool
    {
        return false;
    }

    /**
     * Returns the highest numeric value in the code point range of
     * the encoding.
     */
    public function maxCodepoint(): int
    {
        return static::CODEPOINT_MAX;
    }

    /**
     * Returns the lowest numeric value in the code point range of
     * the encoding.
     */
    public function minCodepoint(): int
    {
        return static::CODEPOINT_MIN;
    }

    /**
     * Returns the name of the character encoding.
     */
    public function name(): string
    {
        return static::NAME;
    }

    /**
     * If the encoding is fixed-width, it returns the number of bytes
     * required to encode its characters; otherwise it returns `null`.
     */
    public function width(): ?int
    {
        return static::WIDTH;
    }

    /**
     * Returns a string containing the character specified by the code
     * point value.
     */
    abstract public function char(int $codepoint): string;

    /**
     * Returns the code point value of the given character.
     */
    abstract public function code(string $character): int;

    /**
     * Returns the general category value for the character.
     */
    public function charCategory(string $character): int
    {
        $utf8 = Utf8::encoding();

        return $utf8->charCategory(mb_convert_encoding(
            $character,
            $utf8->name(),
            $this->name()
        ));
    }

    /**
     * Returns the bidirectional category value for the character,
     * which is used in the [Unicode bidirectional algorithm
     * (UAX #9)](http://www.unicode.org/reports/tr9/).
     */
    public function charDirection(string $character): int
    {
        $utf8 = Utf8::encoding();

        return $utf8->charDirection(mb_convert_encoding(
            $character,
            $utf8->name(),
            $this->name()
        ));
    }

    /**
     * Returns the name for the character.
     */
    public function charName(string $character): string
    {
        $utf8 = Utf8::encoding();

        return $utf8->charName(mb_convert_encoding(
            $character,
            $utf8->name(),
            $this->name()
        ));
    }

    /**
     * Returns the script property value for the character.
     */
    public function charScript(string $character): int
    {
        $utf8 = Utf8::encoding();

        return $utf8->charScript(mb_convert_encoding(
            $character,
            $utf8->name(),
            $this->name()
        ));
    }

    /**
     * Returns `true` if the specified character is a control
     * character; otherwise returns `false`.
     */
    public function charIsControl(string $character): bool
    {
        return in_array($this->charCategory($character), [
            Category::CONTROL_CHAR,
            Category::FORMAT_CHAR,
            Category::LINE_SEPARATOR,
            Category::PARAGRAPH_SEPARATOR,
        ], true);
    }

    /**
     * Returns `true` if the specified character is a decimal digit;
     * otherwise returns `false`.
     */
    public function charIsDigit(string $character): bool
    {
        return (Category::DECIMAL_DIGIT_NUMBER === $this->charCategory($character));
    }

    /**
     * Returns `true` if the specified character is a letter;
     * otherwise returns `false`.
     */
    public function charIsLetter(string $character): bool
    {
        return in_array($this->charCategory($character), [
            Category::UPPERCASE_LETTER,
            Category::LOWERCASE_LETTER,
            Category::TITLECASE_LETTER,
            Category::MODIFIER_LETTER,
        ], true);
    }

    /**
     * Returns `true` if the specified character is a letter or
     * number; otherwise returns `false`.
     */
    public function charIsLetterOrNumber(string $character): bool
    {
        return in_array($this->charCategory($character), [
            Category::UPPERCASE_LETTER,
            Category::LOWERCASE_LETTER,
            Category::TITLECASE_LETTER,
            Category::MODIFIER_LETTER,
            Category::DECIMAL_DIGIT_NUMBER,
            Category::LETTER_NUMBER,
            Category::OTHER_NUMBER,
        ], true);
    }

    /**
     * Returns `true` if the specified character is a lowercase
     * letter; otherwise returns `false`.
     */
    public function charIsLower(string $character): bool
    {
        return (Category::LOWERCASE_LETTER === $this->charCategory($character));
    }

    /**
     * Returns `true` if the specified character is a mark; otherwise
     * returns `false`.
     */
    public function charIsMark(string $character): bool
    {
        return in_array($this->charCategory($character), [
            Category::NON_SPACING_MARK,
            Category::ENCLOSING_MARK,
            Category::COMBINING_SPACING_MARK,
        ], true);
    }

    /**
     * Returns `true` if the specified character is the Unicode
     * character 0x0000 ('\0'); otherwise returns `false`.
     */
    public function charIsNull(string $character): bool
    {
        return $this->codeIsNull($this->code($character));
    }

    /**
     * Returns `true` if the specified character is a number;
     * otherwise returns `false`.
     */
    public function charIsNumber(string $character): bool
    {
        return in_array($this->charCategory($character), [
            Category::DECIMAL_DIGIT_NUMBER,
            Category::LETTER_NUMBER,
            Category::OTHER_NUMBER,
        ], true);
    }

    /**
     * Returns `true` if the specified character is a printable
     * character; otherwise returns `false`.
     */
    public function charIsPrintable(string $character): bool
    {
        return !in_array($this->charCategory($character), [
            Category::CONTROL_CHAR,
            Category::FORMAT_CHAR,
            Category::LINE_SEPARATOR,
            Category::PARAGRAPH_SEPARATOR,
        ], true);
    }

    /**
     * Returns `true` if the specified character is a punctuation
     * mark; otherwise returns `false`.
     */
    public function charIsPunctuation(string $character): bool
    {
        return in_array($this->charCategory($character), [
            Category::DASH_PUNCTUATION,
            Category::OPEN_PUNCTUATION,
            Category::CLOSE_PUNCTUATION,
            Category::CONNECTOR_PUNCTUATION,
            Category::OTHER_PUNCTUATION,
            Category::INITIAL_QUOTE_PUNCTUATION,
            Category::FINAL_QUOTE_PUNCTUATION,
        ], true);
    }

    /**
     * Returns `true` if the specified character is a separator
     * character; otherwise returns `false`.
     */
    public function charIsSeparator(string $character): bool
    {
        return in_array($this->charCategory($character), [
            Category::SPACE_SEPARATOR,
            Category::LINE_SEPARATOR,
            Category::PARAGRAPH_SEPARATOR,
        ], true);
    }

    /**
     * Returns `true` if the specified character is a symbol;
     * otherwise returns `false`.
     */
    public function charIsSymbol(string $character): bool
    {
        return in_array($this->charCategory($character), [
            Category::MATH_SYMBOL,
            Category::CURRENCY_SYMBOL,
            Category::MODIFIER_SYMBOL,
            Category::OTHER_SYMBOL,
        ], true);
    }

    /**
     * Returns `true` if the specified character is a titlecase
     * letter; otherwise returns `false`.
     */
    public function charIsTitle(string $character): bool
    {
        return (Category::TITLECASE_LETTER === $this->charCategory($character));
    }

    /**
     * Returns `true` if the specified character is an uppercase
     * letter; otherwise returns `false`.
     */
    public function charIsUpper(string $character): bool
    {
        return (Category::UPPERCASE_LETTER === $this->charCategory($character));
    }

    /**
     * Returns whether the character is valid for the encoding.
     */
    public function charIsValid(string $character): bool
    {
        return mb_check_encoding($character, $this->name());
    }

    /**
     * Returns `true` if the specified character is visible; otherwise
     * returns `false`.
     */
    public function charIsVisible(string $character): bool
    {
        return in_array($this->charCategory($character), [
            Category::CONTROL_CHAR,
            Category::FORMAT_CHAR,
            Category::SPACE_SEPARATOR,
            Category::LINE_SEPARATOR,
            Category::PARAGRAPH_SEPARATOR,
        ], true);
    }

    /**
     * Returns `true` if the specified character is a whitespace;
     * otherwise returns `false`.
     */
    public function charIsWhitespace(string $character): bool
    {
        return $this->codeIsWhitespace($this->code($character));
    }

    /**
     * Returns the general category value for the code point.
     */
    public function codeCategory(int $codepoint): int
    {
        $utf8 = Utf8::encoding();

        return $utf8->codeCategory(mb_convert_encoding(
            $this->char($codepoint),
            $utf8->name(),
            $this->name()
        ));
    }

    /**
     * Returns the bidirectional category value for the code point,
     * which is used in the [Unicode bidirectional algorithm
     * (UAX #9)](http://www.unicode.org/reports/tr9/).
     */
    public function codeDirection(int $codepoint): int
    {
        $utf8 = Utf8::encoding();

        return $utf8->codeDirection(mb_convert_encoding(
            $this->char($codepoint),
            $utf8->name(),
            $this->name()
        ));
    }

    /**
     * Returns the name for the code point.
     */
    public function codeName(int $codepoint): string
    {
        $utf8 = Utf8::encoding();

        return $utf8->codeName(mb_convert_encoding(
            $this->char($codepoint),
            $utf8->name(),
            $this->name()
        ));
    }

    /**
     * Returns the script property value for the code point.
     */
    public function codeScript(int $codepoint): int
    {
        $utf8 = Utf8::encoding();

        return $utf8->codeScript(mb_convert_encoding(
            $this->char($codepoint),
            $utf8->name(),
            $this->name()
        ));
    }

    /**
     * Returns `true` if the specified code point is a control
     * character; otherwise returns `false`.
     */
    public function codeIsControl(int $codepoint): bool
    {
        return in_array($this->codeCategory($codepoint), [
            Category::CONTROL_CHAR,
            Category::FORMAT_CHAR,
            Category::LINE_SEPARATOR,
            Category::PARAGRAPH_SEPARATOR,
        ], true);
    }

    /**
     * Returns `true` if the specified code point is a decimal digit;
     * otherwise returns `false`.
     */
    public function codeIsDigit(int $codepoint): bool
    {
        return (Category::DECIMAL_DIGIT_NUMBER === $this->codeCategory($codepoint));
    }

    /**
     * Returns `true` if the specified code point is a letter;
     * otherwise returns `false`.
     */
    public function codeIsLetter(int $codepoint): bool
    {
        return in_array($this->codeCategory($codepoint), [
            Category::UPPERCASE_LETTER,
            Category::LOWERCASE_LETTER,
            Category::TITLECASE_LETTER,
            Category::MODIFIER_LETTER,
        ], true);
    }

    /**
     * Returns `true` if the specified code point is a letter or
     * number; otherwise returns `false`.
     */
    public function codeIsLetterOrNumber(int $codepoint): bool
    {
        return in_array($this->codeCategory($codepoint), [
            Category::UPPERCASE_LETTER,
            Category::LOWERCASE_LETTER,
            Category::TITLECASE_LETTER,
            Category::MODIFIER_LETTER,
            Category::DECIMAL_DIGIT_NUMBER,
            Category::LETTER_NUMBER,
            Category::OTHER_NUMBER,
        ], true);
    }

    /**
     * Returns `true` if the specified code point is a lowercase
     * letter; otherwise returns `false`.
     */
    public function codeIsLower(int $codepoint): bool
    {
        return (Category::LOWERCASE_LETTER === $this->codeCategory($codepoint));
    }

    /**
     * Returns `true` if the specified code point is a mark; otherwise
     * returns `false`.
     */
    public function codeIsMark(int $codepoint): bool
    {
        return in_array($this->codeCategory($codepoint), [
            Category::NON_SPACING_MARK,
            Category::ENCLOSING_MARK,
            Category::COMBINING_SPACING_MARK,
        ], true);
    }

    /**
     * Returns `true` if the specified code point is the Unicode
     * character 0x0000 ('\0'); otherwise returns `false`.
     */
    public function codeIsNull(int $codepoint): bool
    {
        return (0 === $codepoint);
    }

    /**
     * Returns `true` if the specified code point is a number;
     * otherwise returns `false`.
     */
    public function codeIsNumber(int $codepoint): bool
    {
        return in_array($this->codeCategory($codepoint), [
            Category::DECIMAL_DIGIT_NUMBER,
            Category::LETTER_NUMBER,
            Category::OTHER_NUMBER,
        ], true);
    }

    /**
     * Returns `true` if the specified code point is a printable
     * character; otherwise returns `false`.
     */
    public function codeIsPrintable(int $codepoint): bool
    {
        return !in_array($this->codeCategory($codepoint), [
            Category::CONTROL_CHAR,
            Category::FORMAT_CHAR,
            Category::LINE_SEPARATOR,
            Category::PARAGRAPH_SEPARATOR,
        ], true);
    }

    /**
     * Returns `true` if the specified code point is a punctuation
     * mark; otherwise returns `false`.
     */
    public function codeIsPunctuation(int $codepoint): bool
    {
        return in_array($this->codeCategory($codepoint), [
            Category::DASH_PUNCTUATION,
            Category::OPEN_PUNCTUATION,
            Category::CLOSE_PUNCTUATION,
            Category::CONNECTOR_PUNCTUATION,
            Category::OTHER_PUNCTUATION,
            Category::INITIAL_QUOTE_PUNCTUATION,
            Category::FINAL_QUOTE_PUNCTUATION,
        ], true);
    }

    /**
     * Returns `true` if the specified code point is a separator
     * character; otherwise returns `false`.
     */
    public function codeIsSeparator(int $codepoint): bool
    {
        return in_array($this->codeCategory($codepoint), [
            Category::SPACE_SEPARATOR,
            Category::LINE_SEPARATOR,
            Category::PARAGRAPH_SEPARATOR,
        ], true);
    }

    /**
     * Returns `true` if the specified code point is a symbol;
     * otherwise returns `false`.
     */
    public function codeIsSymbol(int $codepoint): bool
    {
        return in_array($this->codeCategory($codepoint), [
            Category::MATH_SYMBOL,
            Category::CURRENCY_SYMBOL,
            Category::MODIFIER_SYMBOL,
            Category::OTHER_SYMBOL,
        ], true);
    }

    /**
     * Returns `true` if the specified code point is a titlecase
     * letter; otherwise returns `false`.
     */
    public function codeIsTitle(int $codepoint): bool
    {
        return (Category::TITLECASE_LETTER === $this->codeCategory($codepoint));
    }

    /**
     * Returns `true` if the specified code point is an uppercase
     * letter; otherwise returns `false`.
     */
    public function codeIsUpper(int $codepoint): bool
    {
        return (Category::UPPERCASE_LETTER === $this->codeCategory($codepoint));
    }

    /**
     * Returns whether the code point is valid for the encoding.
     */
    public function codeIsValid(int $codepoint): bool
    {
        try {
            $character = $this->char($codepoint);
        } catch (UnexpectedValueException) {
            return false;
        }

        return $this->charIsValid($character);
    }

    /**
     * Returns `true` if the specified code point is visible;
     * otherwise returns `false`.
     */
    public function codeIsVisible(int $codepoint): bool
    {
        return in_array($this->codeCategory($codepoint), [
            Category::CONTROL_CHAR,
            Category::FORMAT_CHAR,
            Category::SPACE_SEPARATOR,
            Category::LINE_SEPARATOR,
            Category::PARAGRAPH_SEPARATOR,
        ], true);
    }

    /**
     * Returns `true` if the specified code point is a whitespace;
     * otherwise returns `false`.
     */
    public function codeIsWhitespace(int $codepoint): bool
    {
        if ($this->isSingleByte()) {
            $character = $this->char($codepoint);
            return str_contains($character, static::WHITESPACES);
        }

        if ($this->isAsciiCompatible()) {
            $ascii = Ascii::encoding();

            if ($ascii->codeIsValid($codepoint)) {
                return $ascii->codeIsWhitespace($codepoint);
            }
        }

        return (Category::SPACE_SEPARATOR === $this->codeCategory($codepoint));
    }
}
