<?php

namespace Hereldar\CharacterEncodings;

/**
 * @see https://encoding.spec.whatwg.org/
 * @see https://en.wikipedia.org/wiki/Unicode_character_property
 * @see https://www.php.net/manual/en/class.intlchar.php
 * @see https://doc.qt.io/qt-6/qchar.html
 */
interface IEncoding
{
    /**
     * Returns `true` if the encoding includes the standard seven-bit
     * ASCII characters; otherwise returns `false`.
     *
     * @return bool
     */
    public function isAsciiCompatible(): bool;

    /**
     * Returns `true` if the encoding uses a fixed number of bytes to
     * encode its characters; otherwise returns `false`.
     *
     * @return bool
     */
    public function isFixedWidth(): bool;

    /**
     * Returns `true` if the encoding uses more than one byte to
     * encode a single character; otherwise returns `false`.
     *
     * @return bool
     */
    public function isMultiByte(): bool;

    /**
     * Returns `true` if a part of any codeword in the encoding, or
     * the overlapping part of any two adjacent codewords, is not a
     * valid codeword; otherwise returns `false`.
     *
     * @return bool
     */
    public function isSelfSynchronized(): bool;

    /**
     * Returns `true` if the encoding uses a single byte to encode all
     * its characters; otherwise returns `false`.
     *
     * @return bool
     */
    public function isSingleByte(): bool;

    /**
     * Returns `true` if the encoding is capable of encoding all valid
     * character code points in Unicode; otherwise returns `false`.
     *
     * @return bool
     */
    public function isUnicode(): bool;

    /**
     * Returns `true` if the encoding uses varying numbers of bytes
     * to encode different characters; otherwise returns `false`.
     *
     * @return bool
     */
    public function isVariableWidth(): bool;

    /**
     * Returns the highest numeric value in the code point range of
     * the encoding.
     *
     * @return int
     */
    public function maxCodepoint(): int;

    /**
     * Returns the lowest numeric value in the code point range of
     * the encoding.
     *
     * @return int
     */
    public function minCodepoint(): int;

    /**
     * Returns the name of the character encoding.
     *
     * @return string
     */
    public function name(): string;

    /**
     * If the encoding is fixed-width, it returns the number of bytes
     * required to encode its characters; otherwise it returns `null`.
     *
     * @return int|null
     */
    public function width(): ?int;

    /**
     * Returns a string containing the character specified by the code
     * point value.
     *
     * @param int $codepoint
     * @return string
     */
    public function char(int $codepoint): string;

    /**
     * Returns the code point value of the given character.
     *
     * @param string $character
     * @return int
     */
    public function code(string $character): int;

    /**
     * Returns the general category value for the character.
     *
     * @param string $character
     * @return int
     */
    public function charCategory(string $character): int;

    /**
     * Returns the bidirectional category value for the character,
     * which is used in the [Unicode bidirectional algorithm
     * (UAX #9)](http://www.unicode.org/reports/tr9/).
     *
     * @param string $character
     * @return int
     */
    public function charDirection(string $character): int;

    /**
     * Returns the name for the character.
     *
     * @param string $character
     * @return string
     */
    public function charName(string $character): string;

    /**
     * Returns the script property value for the character.
     *
     * @param string $character
     * @return int
     */
    public function charScript(string $character): int;

    /**
     * Returns `true` if the specified character is a control
     * character; otherwise returns `false`.
     *
     * @param string $character
     * @return bool
     */
    public function charIsControl(string $character): bool;

    /**
     * Returns `true` if the specified character is a decimal digit;
     * otherwise returns `false`.
     *
     * @param string $character
     * @return bool
     */
    public function charIsDigit(string $character): bool;

    /**
     * Returns `true` if the specified character is a letter;
     * otherwise returns `false`.
     *
     * @param string $character
     * @return bool
     */
    public function charIsLetter(string $character): bool;

    /**
     * Returns `true` if the specified character is a letter or
     * number; otherwise returns `false`.
     *
     * @param string $character
     * @return bool
     */
    public function charIsLetterOrNumber(string $character): bool;

    /**
     * Returns `true` if the specified character is a lowercase
     * letter; otherwise returns `false`.
     *
     * @param string $character
     * @return bool
     */
    public function charIsLower(string $character): bool;

    /**
     * Returns `true` if the specified character is a mark; otherwise
     * returns `false`.
     *
     * @param string $character
     * @return bool
     */
    public function charIsMark(string $character): bool;

    /**
     * Returns `true` if the specified character is the Unicode
     * character 0x0000 ('\0'); otherwise returns `false`.
     *
     * @param string $character
     * @return bool
     */
    public function charIsNull(string $character): bool;

    /**
     * Returns `true` if the specified character is a number;
     * otherwise returns `false`.
     *
     * @param string $character
     * @return bool
     */
    public function charIsNumber(string $character): bool;

    /**
     * Returns `true` if the specified character is a printable
     * character; otherwise returns `false`.
     *
     * @param string $character
     * @return bool
     */
    public function charIsPrintable(string $character): bool;

    /**
     * Returns `true` if the specified character is a punctuation
     * mark; otherwise returns `false`.
     *
     * @param string $character
     * @return bool
     */
    public function charIsPunctuation(string $character): bool;

    /**
     * Returns `true` if the specified character is a separator
     * character; otherwise returns `false`.
     *
     * @param string $character
     * @return bool
     */
    public function charIsSeparator(string $character): bool;

    /**
     * Returns `true` if the specified character is a symbol;
     * otherwise returns `false`.
     *
     * @param string $character
     * @return bool
     */
    public function charIsSymbol(string $character): bool;

    /**
     * Returns `true` if the specified character is a titlecase
     * letter; otherwise returns `false`.
     *
     * @param string $character
     * @return bool
     */
    public function charIsTitle(string $character): bool;

    /**
     * Returns `true` if the specified character is an uppercase
     * letter; otherwise returns `false`.
     *
     * @param string $character
     * @return bool
     */
    public function charIsUpper(string $character): bool;

    /**
     * Returns whether the character is valid for the encoding.
     *
     * @param string $character
     * @return bool
     */
    public function charIsValid(string $character): bool;

    /**
     * Returns `true` if the specified character is visible; otherwise
     * returns `false`.
     *
     * @param string $character
     * @return bool
     */
    public function charIsVisible(string $character): bool;

    /**
     * Returns `true` if the specified character is a whitespace;
     * otherwise returns `false`.
     *
     * @param string $character
     * @return bool
     */
    public function charIsWhitespace(string $character): bool;

    /**
     * Returns the general category value for the code point.
     *
     * @param int $codepoint
     * @return int
     */
    public function codeCategory(int $codepoint): int;

    /**
     * Returns the bidirectional category value for the code point,
     * which is used in the [Unicode bidirectional algorithm
     * (UAX #9)](http://www.unicode.org/reports/tr9/).
     *
     * @param int $codepoint
     * @return int
     */
    public function codeDirection(int $codepoint): int;

    /**
     * Returns the name for the code point.
     *
     * @param int $codepoint
     * @return string
     */
    public function codeName(int $codepoint): string;

    /**
     * Returns the script property value for the code point.
     *
     * @param int $codepoint
     * @return int
     */
    public function codeScript(int $codepoint): int;

    /**
     * Returns `true` if the specified code point is a control
     * character; otherwise returns `false`.
     *
     * @param int $codepoint
     * @return bool
     */
    public function codeIsControl(int $codepoint): bool;

    /**
     * Returns `true` if the specified code point is a decimal digit;
     * otherwise returns `false`.
     *
     * @param int $codepoint
     * @return bool
     */
    public function codeIsDigit(int $codepoint): bool;

    /**
     * Returns `true` if the specified code point is a letter;
     * otherwise returns `false`.
     *
     * @param int $codepoint
     * @return bool
     */
    public function codeIsLetter(int $codepoint): bool;

    /**
     * Returns `true` if the specified code point is a letter or
     * number; otherwise returns `false`.
     *
     * @param int $codepoint
     * @return bool
     */
    public function codeIsLetterOrNumber(int $codepoint): bool;

    /**
     * Returns `true` if the specified code point is a lowercase
     * letter; otherwise returns `false`.
     *
     * @param int $codepoint
     * @return bool
     */
    public function codeIsLower(int $codepoint): bool;

    /**
     * Returns `true` if the specified code point is a mark; otherwise
     * returns `false`.
     *
     * @param int $codepoint
     * @return bool
     */
    public function codeIsMark(int $codepoint): bool;

    /**
     * Returns `true` if the specified code point is the Unicode
     * character 0x0000 ('\0'); otherwise returns `false`.
     *
     * @param int $codepoint
     * @return bool
     */
    public function codeIsNull(int $codepoint): bool;

    /**
     * Returns `true` if the specified code point is a number;
     * otherwise returns `false`.
     *
     * @param int $codepoint
     * @return bool
     */
    public function codeIsNumber(int $codepoint): bool;

    /**
     * Returns `true` if the specified code point is a printable
     * character; otherwise returns `false`.
     *
     * @param int $codepoint
     * @return bool
     */
    public function codeIsPrintable(int $codepoint): bool;

    /**
     * Returns `true` if the specified code point is a punctuation
     * mark; otherwise returns `false`.
     *
     * @param int $codepoint
     * @return bool
     */
    public function codeIsPunctuation(int $codepoint): bool;

    /**
     * Returns `true` if the specified code point is a separator
     * character; otherwise returns `false`.
     *
     * @param int $codepoint
     * @return bool
     */
    public function codeIsSeparator(int $codepoint): bool;

    /**
     * Returns `true` if the specified code point is a symbol;
     * otherwise returns `false`.
     *
     * @param int $codepoint
     * @return bool
     */
    public function codeIsSymbol(int $codepoint): bool;

    /**
     * Returns `true` if the specified code point is a titlecase
     * letter; otherwise returns `false`.
     *
     * @param int $codepoint
     * @return bool
     */
    public function codeIsTitle(int $codepoint): bool;

    /**
     * Returns `true` if the specified code point is an uppercase
     * letter; otherwise returns `false`.
     *
     * @param int $codepoint
     * @return bool
     */
    public function codeIsUpper(int $codepoint): bool;

    /**
     * Returns whether the code point is valid for the encoding.
     *
     * @param int $codepoint
     * @return bool
     */
    public function codeIsValid(int $codepoint): bool;

    /**
     * Returns `true` if the specified code point is visible;
     * otherwise returns `false`.
     *
     * @param int $codepoint
     * @return bool
     */
    public function codeIsVisible(int $codepoint): bool;

    /**
     * Returns `true` if the specified code point is a whitespace;
     * otherwise returns `false`.
     *
     * @param int $codepoint
     * @return bool
     */
    public function codeIsWhitespace(int $codepoint): bool;
}