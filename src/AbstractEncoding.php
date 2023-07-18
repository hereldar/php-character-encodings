<?php

namespace Hereldar\CharacterEncodings;

use Hereldar\CharacterEncodings\Enums\Category;
use UnexpectedValueException;

abstract class AbstractEncoding implements IEncoding
{
    private static array $instances = [];

    private function __construct()
    {
    }

    public function __toString(): string
    {
        return $this->name();
    }

    public static function encoding(): IEncoding
    {
        $class = static::class;

        if (isset(self::$instances[$class])) {
            return self::$instances[$class];
        }

        return self::$instances[$class] = new static();
    }

    public function isAsciiCompatible(): bool
    {
        return false;
    }

    public function isFixedWidth(): bool
    {
        return !$this->isVariableWidth();
    }

    public function isMultiByte(): bool
    {
        return !$this->isSingleByte();
    }

    public function isSelfSynchronized(): bool
    {
        return $this->isSingleByte();
    }

    public function isSingleByte(): bool
    {
        return false;
    }

    public function isUnicode(): bool
    {
        return false;
    }

    public function isVariableWidth(): bool
    {
        return false;
    }

    public function maxCodepoint(): int
    {
        return static::CODEPOINT_MAX;
    }

    public function minCodepoint(): int
    {
        return static::CODEPOINT_MIN;
    }

    public function name(): string
    {
        return static::NAME;
    }

    public function width(): ?int
    {
        return static::WIDTH;
    }

    public function charCategory(string $character): int
    {
        $utf8 = Utf8::encoding();

        return $utf8->charCategory(mb_convert_encoding(
            $character,
            $utf8->name(),
            $this->name()
        ));
    }

    public function charDirection(string $character): int
    {
        $utf8 = Utf8::encoding();

        return $utf8->charDirection(mb_convert_encoding(
            $character,
            $utf8->name(),
            $this->name()
        ));
    }

    public function charName(string $character): string
    {
        $utf8 = Utf8::encoding();

        return $utf8->charName(mb_convert_encoding(
            $character,
            $utf8->name(),
            $this->name()
        ));
    }

    public function charScript(string $character): int
    {
        $utf8 = Utf8::encoding();

        return $utf8->charScript(mb_convert_encoding(
            $character,
            $utf8->name(),
            $this->name()
        ));
    }

    public function charIsControl(string $character): bool
    {
        return in_array($this->charCategory($character), [
            Category::CONTROL_CHAR,
            Category::FORMAT_CHAR,
            Category::LINE_SEPARATOR,
            Category::PARAGRAPH_SEPARATOR,
        ], true);
    }

    public function charIsDigit(string $character): bool
    {
        return (Category::DECIMAL_DIGIT_NUMBER === $this->charCategory($character));
    }

    public function charIsLetter(string $character): bool
    {
        return in_array($this->charCategory($character), [
            Category::UPPERCASE_LETTER,
            Category::LOWERCASE_LETTER,
            Category::TITLECASE_LETTER,
            Category::MODIFIER_LETTER,
        ], true);
    }

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

    public function charIsLower(string $character): bool
    {
        return (Category::LOWERCASE_LETTER === $this->charCategory($character));
    }

    public function charIsMark(string $character): bool
    {
        return in_array($this->charCategory($character), [
            Category::NON_SPACING_MARK,
            Category::ENCLOSING_MARK,
            Category::COMBINING_SPACING_MARK,
        ], true);
    }

    public function charIsNull(string $character): bool
    {
        return $this->codeIsNull($this->code($character));
    }

    public function charIsNumber(string $character): bool
    {
        return in_array($this->charCategory($character), [
            Category::DECIMAL_DIGIT_NUMBER,
            Category::LETTER_NUMBER,
            Category::OTHER_NUMBER,
        ], true);
    }

    public function charIsPrintable(string $character): bool
    {
        return !in_array($this->charCategory($character), [
            Category::CONTROL_CHAR,
            Category::FORMAT_CHAR,
            Category::LINE_SEPARATOR,
            Category::PARAGRAPH_SEPARATOR,
        ], true);
    }

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

    public function charIsSeparator(string $character): bool
    {
        return in_array($this->charCategory($character), [
            Category::SPACE_SEPARATOR,
            Category::LINE_SEPARATOR,
            Category::PARAGRAPH_SEPARATOR,
        ], true);
    }

    public function charIsSymbol(string $character): bool
    {
        return in_array($this->charCategory($character), [
            Category::MATH_SYMBOL,
            Category::CURRENCY_SYMBOL,
            Category::MODIFIER_SYMBOL,
            Category::OTHER_SYMBOL,
        ], true);
    }

    public function charIsTitle(string $character): bool
    {
        return (Category::TITLECASE_LETTER === $this->charCategory($character));
    }

    public function charIsUpper(string $character): bool
    {
        return (Category::UPPERCASE_LETTER === $this->charCategory($character));
    }

    public function charIsValid(string $character): bool
    {
        return mb_check_encoding($character, $this->name());
    }

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

    public function charIsWhitespace(string $character): bool
    {
        return $this->codeIsWhitespace($this->code($character));
    }

    public function codeCategory(int $codepoint): int
    {
        $utf8 = Utf8::encoding();

        return $utf8->codeCategory(mb_convert_encoding(
            $this->char($codepoint),
            $utf8->name(),
            $this->name()
        ));
    }

    public function codeDirection(int $codepoint): int
    {
        $utf8 = Utf8::encoding();

        return $utf8->codeDirection(mb_convert_encoding(
            $this->char($codepoint),
            $utf8->name(),
            $this->name()
        ));
    }

    public function codeName(int $codepoint): string
    {
        $utf8 = Utf8::encoding();

        return $utf8->codeName(mb_convert_encoding(
            $this->char($codepoint),
            $utf8->name(),
            $this->name()
        ));
    }

    public function codeScript(int $codepoint): int
    {
        $utf8 = Utf8::encoding();

        return $utf8->codeScript(mb_convert_encoding(
            $this->char($codepoint),
            $utf8->name(),
            $this->name()
        ));
    }

    public function codeIsControl(int $codepoint): bool
    {
        return in_array($this->codeCategory($codepoint), [
            Category::CONTROL_CHAR,
            Category::FORMAT_CHAR,
            Category::LINE_SEPARATOR,
            Category::PARAGRAPH_SEPARATOR,
        ], true);
    }

    public function codeIsDigit(int $codepoint): bool
    {
        return (Category::DECIMAL_DIGIT_NUMBER === $this->codeCategory($codepoint));
    }

    public function codeIsLetter(int $codepoint): bool
    {
        return in_array($this->codeCategory($codepoint), [
            Category::UPPERCASE_LETTER,
            Category::LOWERCASE_LETTER,
            Category::TITLECASE_LETTER,
            Category::MODIFIER_LETTER,
        ], true);
    }

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

    public function codeIsLower(int $codepoint): bool
    {
        return (Category::LOWERCASE_LETTER === $this->codeCategory($codepoint));
    }

    public function codeIsMark(int $codepoint): bool
    {
        return in_array($this->codeCategory($codepoint), [
            Category::NON_SPACING_MARK,
            Category::ENCLOSING_MARK,
            Category::COMBINING_SPACING_MARK,
        ], true);
    }

    public function codeIsNull(int $codepoint): bool
    {
        return (0 === $codepoint);
    }

    public function codeIsNumber(int $codepoint): bool
    {
        return in_array($this->codeCategory($codepoint), [
            Category::DECIMAL_DIGIT_NUMBER,
            Category::LETTER_NUMBER,
            Category::OTHER_NUMBER,
        ], true);
    }

    public function codeIsPrintable(int $codepoint): bool
    {
        return !in_array($this->codeCategory($codepoint), [
            Category::CONTROL_CHAR,
            Category::FORMAT_CHAR,
            Category::LINE_SEPARATOR,
            Category::PARAGRAPH_SEPARATOR,
        ], true);
    }

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

    public function codeIsSeparator(int $codepoint): bool
    {
        return in_array($this->codeCategory($codepoint), [
            Category::SPACE_SEPARATOR,
            Category::LINE_SEPARATOR,
            Category::PARAGRAPH_SEPARATOR,
        ], true);
    }

    public function codeIsSymbol(int $codepoint): bool
    {
        return in_array($this->codeCategory($codepoint), [
            Category::MATH_SYMBOL,
            Category::CURRENCY_SYMBOL,
            Category::MODIFIER_SYMBOL,
            Category::OTHER_SYMBOL,
        ], true);
    }

    public function codeIsTitle(int $codepoint): bool
    {
        return (Category::TITLECASE_LETTER === $this->codeCategory($codepoint));
    }

    public function codeIsUpper(int $codepoint): bool
    {
        return (Category::UPPERCASE_LETTER === $this->codeCategory($codepoint));
    }

    public function codeIsValid(int $codepoint): bool
    {
        try {
            $character = $this->char($codepoint);
        } catch (UnexpectedValueException) {
            return false;
        }

        return $this->charIsValid($character);
    }

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

    public function validateCode(int $codepoint): void
    {
        if ($codepoint < $this->minCodepoint()
            || $codepoint > $this->maxCodepoint()) {
            throw new UnexpectedValueException();
        }
    }
}
