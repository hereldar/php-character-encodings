<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings;

use Generator;
use Hereldar\CharacterEncodings\Enums\Category;
use Hereldar\CharacterEncodings\Enums\CategoryGroup;
use Hereldar\CharacterEncodings\Enums\Direction;
use Hereldar\CharacterEncodings\Enums\Script;
use Hereldar\CharacterEncodings\Exceptions\InvalidCharacter;
use Hereldar\CharacterEncodings\Exceptions\InvalidCodepoint;
use Stringable;
use UnexpectedValueException;

/**
 * @psalm-consistent-constructor
 *
 * @see https://encoding.spec.whatwg.org/
 * @see https://en.wikipedia.org/wiki/Unicode_character_property
 * @see https://www.php.net/manual/en/class.intlchar.php
 * @see https://doc.qt.io/qt-6/qchar.html
 */
abstract class CharacterEncoding implements Stringable
{
    /** @var non-empty-string */
    public const NAME = '';   // @phpstan-ignore-line

    /** @var positive-int|null */
    public const WIDTH = null;

    /** @var positive-int */
    public const CODEPOINT_MAX = PHP_INT_MAX;

    /** @var non-negative-int */
    public const CODEPOINT_MIN = 0;

    /** @var array<class-string, static> */
    private static array $instances = [];

    protected function __construct()
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
    abstract public function isFixedWidth(): bool;

    /**
     * Returns `true` if the encoding uses more than one byte to
     * encode a single character; otherwise returns `false`.
     */
    abstract public function isMultiByte(): bool;

    /**
     * Returns `true` if a part of any codeword in the encoding, or
     * the overlapping part of any two adjacent codewords, is not a
     * valid codeword; otherwise returns `false`.
     */
    public function isSelfSynchronized(): bool
    {
        return false;
    }

    /**
     * Returns `true` if the encoding uses a single byte to encode all
     * its characters; otherwise returns `false`.
     */
    abstract public function isSingleByte(): bool;

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
    abstract public function isVariableWidth(): bool;

    /**
     * Returns the highest numeric value in the code point range of
     * the encoding.
     *
     * @return positive-int
     */
    public function maxCodepoint(): int
    {
        return static::CODEPOINT_MAX;
    }

    /**
     * Returns the lowest numeric value in the code point range of
     * the encoding.
     *
     * @return non-negative-int
     */
    public function minCodepoint(): int
    {
        return static::CODEPOINT_MIN;
    }

    /**
     * Returns the name of the character encoding.
     *
     * @return non-empty-string
     */
    public function name(): string
    {
        return static::NAME;
    }

    /**
     * If the encoding is fixed-width, it returns the number of bytes
     * required to encode its characters; otherwise it returns `null`.
     *
     * @return positive-int|null
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
     * @return Generator<string>
     */
    abstract public function chars(): Generator;

    /**
     * Returns the code point value of the given character.
     */
    abstract public function code(string $character): int;

    /**
     * @return Generator<int>
     */
    abstract public function codes(): Generator;

    /**
     * Returns the general category value for the character.
     */
    abstract public function charCategory(string $character): Category;

    /**
     * Returns the bidirectional category value for the character,
     * which is used in the [Unicode bidirectional algorithm
     * (UAX #9)](http://www.unicode.org/reports/tr9/).
     */
    abstract public function charDirection(string $character): Direction;

    /**
     * Returns the name for the character.
     */
    abstract public function charName(string $character): string;

    /**
     * Returns the script property value for the character.
     */
    abstract public function charScript(string $character): Script;

    /**
     * Returns `true` if the specified character is part of the 7-bit
     * ASCII set; otherwise returns `false`.
     */
    public function charIsAscii(string $character): bool
    {
        return false;
    }

    /**
     * Returns `true` if the specified character is a control
     * character; otherwise returns `false`.
     */
    public function charIsControl(string $character): bool
    {
        return (CategoryGroup::Other === $this->charCategory($character)->group());
    }

    /**
     * Returns `true` if the specified character is a decimal digit;
     * otherwise returns `false`.
     */
    public function charIsDigit(string $character): bool
    {
        return (Category::DecimalDigitNumber === $this->charCategory($character));
    }

    /**
     * Returns `true` if the specified character is a letter;
     * otherwise returns `false`.
     */
    public function charIsLetter(string $character): bool
    {
        return (CategoryGroup::Letter === $this->charCategory($character)->group());
    }

    /**
     * Returns `true` if the specified character is a letter or
     * decimal digit; otherwise returns `false`.
     */
    public function charIsLetterOrDigit(string $character): bool
    {
        $category = $this->charCategory($character);

        return (CategoryGroup::Letter === $category->group())
            || (Category::DecimalDigitNumber === $category);
    }

    /**
     * Returns `true` if the specified character is a letter or
     * number; otherwise returns `false`.
     */
    public function charIsLetterOrNumber(string $character): bool
    {
        $categoryGroup = $this->charCategory($character)->group();

        return (CategoryGroup::Letter === $categoryGroup)
            || (CategoryGroup::Number === $categoryGroup);
    }

    /**
     * Returns `true` if the specified character is a lowercase
     * letter; otherwise returns `false`.
     */
    public function charIsLower(string $character): bool
    {
        return (Category::LowercaseLetter === $this->charCategory($character));
    }

    /**
     * Returns `true` if the specified character is a mark; otherwise
     * returns `false`.
     */
    public function charIsMark(string $character): bool
    {
        return (CategoryGroup::Mark === $this->charCategory($character)->group());
    }

    /**
     * Returns `true` if the specified character is the Unicode
     * character 0x0000 ('\0'); otherwise returns `false`.
     */
    public function charIsNull(string $character): bool
    {
        if (!$this->charIsValid($character)) {
            throw new InvalidCharacter($this, $character);
        }

        return ("\0" === $character);
    }

    /**
     * Returns `true` if the specified character is a number;
     * otherwise returns `false`.
     */
    public function charIsNumber(string $character): bool
    {
        return (CategoryGroup::Number === $this->charCategory($character)->group());
    }

    /**
     * Returns `true` if the specified character is a printable
     * character; otherwise returns `false`.
     */
    public function charIsPrintable(string $character): bool
    {
        return (CategoryGroup::Other !== $this->charCategory($character)->group());
    }

    /**
     * Returns `true` if the specified character is a punctuation
     * mark; otherwise returns `false`.
     */
    public function charIsPunctuation(string $character): bool
    {
        return (CategoryGroup::Punctuation === $this->charCategory($character)->group());
    }

    /**
     * Returns `true` if the specified character is a separator
     * character; otherwise returns `false`.
     */
    public function charIsSeparator(string $character): bool
    {
        return (CategoryGroup::Separator === $this->charCategory($character)->group());
    }

    /**
     * Returns `true` if the specified character is a symbol;
     * otherwise returns `false`.
     */
    public function charIsSymbol(string $character): bool
    {
        return (CategoryGroup::Symbol === $this->charCategory($character)->group());
    }

    /**
     * Returns `true` if the specified character is a titlecase
     * letter; otherwise returns `false`.
     */
    public function charIsTitle(string $character): bool
    {
        return (Category::TitlecaseLetter === $this->charCategory($character));
    }

    /**
     * Returns `true` if the specified character is an uppercase
     * letter; otherwise returns `false`.
     */
    public function charIsUpper(string $character): bool
    {
        return (Category::UppercaseLetter === $this->charCategory($character));
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
        $category = $this->charCategory($character);

        if (Category::SpaceSeparator === $category
            || CategoryGroup::Other === $category->group()) {
            return false;
        }

        return match ($this->charDirection($character)) {
            Direction::WhiteSpace,
            Direction::ParagraphSeparator,
            Direction::SegmentSeparator => false,
            default => true,
        };
    }

    /**
     * Returns `true` if the specified character is a whitespace;
     * otherwise returns `false`.
     */
    public function charIsWhitespace(string $character): bool
    {
        if (Category::SpaceSeparator === $this->charCategory($character)) {
            return true;
        }

        return match ($this->charDirection($character)) {
            Direction::WhiteSpace,
            Direction::ParagraphSeparator,
            Direction::SegmentSeparator => true,
            default => false,
        };
    }

    /**
     * Returns the general category value for the code point.
     */
    abstract public function codeCategory(int $codepoint): Category;

    /**
     * Returns the bidirectional category value for the code point,
     * which is used in the [Unicode bidirectional algorithm
     * (UAX #9)](http://www.unicode.org/reports/tr9/).
     */
    abstract public function codeDirection(int $codepoint): Direction;

    /**
     * Returns the name for the code point.
     */
    abstract public function codeName(int $codepoint): string;

    /**
     * Returns the script property value for the code point.
     */
    abstract public function codeScript(int $codepoint): Script;

    /**
     * Returns `true` if the specified code point is part of the 7-bit
     * ASCII set; otherwise returns `false`.
     */
    public function codeIsAscii(int $codepoint): bool
    {
        return false;
    }

    /**
     * Returns `true` if the specified code point is a control
     * character; otherwise returns `false`.
     */
    public function codeIsControl(int $codepoint): bool
    {
        return (CategoryGroup::Other === $this->codeCategory($codepoint)->group());
    }

    /**
     * Returns `true` if the specified code point is a decimal digit;
     * otherwise returns `false`.
     */
    public function codeIsDigit(int $codepoint): bool
    {
        return (Category::DecimalDigitNumber === $this->codeCategory($codepoint));
    }

    /**
     * Returns `true` if the specified code point is a letter;
     * otherwise returns `false`.
     */
    public function codeIsLetter(int $codepoint): bool
    {
        return (CategoryGroup::Letter === $this->codeCategory($codepoint)->group());
    }

    /**
     * Returns `true` if the specified code point is a letter or
     * decimal digit; otherwise returns `false`.
     */
    public function codeIsLetterOrDigit(int $codepoint): bool
    {
        $category = $this->codeCategory($codepoint);

        return (CategoryGroup::Letter === $category->group())
            || (Category::DecimalDigitNumber === $category);
    }

    /**
     * Returns `true` if the specified code point is a letter or
     * number; otherwise returns `false`.
     */
    public function codeIsLetterOrNumber(int $codepoint): bool
    {
        $categoryGroup = $this->codeCategory($codepoint)->group();

        return (CategoryGroup::Letter === $categoryGroup)
            || (CategoryGroup::Number === $categoryGroup);
    }

    /**
     * Returns `true` if the specified code point is a lowercase
     * letter; otherwise returns `false`.
     */
    public function codeIsLower(int $codepoint): bool
    {
        return (Category::LowercaseLetter === $this->codeCategory($codepoint));
    }

    /**
     * Returns `true` if the specified code point is a mark; otherwise
     * returns `false`.
     */
    public function codeIsMark(int $codepoint): bool
    {
        return (CategoryGroup::Mark === $this->codeCategory($codepoint)->group());
    }

    /**
     * Returns `true` if the specified code point is the Unicode
     * character 0x0000 ('\0'); otherwise returns `false`.
     */
    public function codeIsNull(int $codepoint): bool
    {
        if (!$this->codeIsValid($codepoint)) {
            throw new InvalidCodepoint($this, $codepoint);
        }

        return (0 === $codepoint);
    }

    /**
     * Returns `true` if the specified code point is a number;
     * otherwise returns `false`.
     */
    public function codeIsNumber(int $codepoint): bool
    {
        return (CategoryGroup::Number === $this->codeCategory($codepoint)->group());
    }

    /**
     * Returns `true` if the specified code point is a printable
     * character; otherwise returns `false`.
     */
    public function codeIsPrintable(int $codepoint): bool
    {
        return (CategoryGroup::Other !== $this->codeCategory($codepoint)->group());
    }

    /**
     * Returns `true` if the specified code point is a punctuation
     * mark; otherwise returns `false`.
     */
    public function codeIsPunctuation(int $codepoint): bool
    {
        return (CategoryGroup::Punctuation === $this->codeCategory($codepoint)->group());
    }

    /**
     * Returns `true` if the specified code point is a separator
     * character; otherwise returns `false`.
     */
    public function codeIsSeparator(int $codepoint): bool
    {
        return (CategoryGroup::Separator === $this->codeCategory($codepoint)->group());
    }

    /**
     * Returns `true` if the specified code point is a symbol;
     * otherwise returns `false`.
     */
    public function codeIsSymbol(int $codepoint): bool
    {
        return (CategoryGroup::Symbol === $this->codeCategory($codepoint)->group());
    }

    /**
     * Returns `true` if the specified code point is a titlecase
     * letter; otherwise returns `false`.
     */
    public function codeIsTitle(int $codepoint): bool
    {
        return (Category::TitlecaseLetter === $this->codeCategory($codepoint));
    }

    /**
     * Returns `true` if the specified code point is an uppercase
     * letter; otherwise returns `false`.
     */
    public function codeIsUpper(int $codepoint): bool
    {
        return (Category::UppercaseLetter === $this->codeCategory($codepoint));
    }

    /**
     * Returns whether the code point is valid for the encoding.
     */
    public function codeIsValid(int $codepoint): bool
    {
        return $codepoint >= static::CODEPOINT_MIN
            && $codepoint <= static::CODEPOINT_MAX;
    }

    /**
     * Returns `true` if the specified code point is visible;
     * otherwise returns `false`.
     */
    public function codeIsVisible(int $codepoint): bool
    {
        $category = $this->codeCategory($codepoint);

        if (Category::SpaceSeparator === $category
            || CategoryGroup::Other === $category->group()) {
            return false;
        }

        return match ($this->codeDirection($codepoint)) {
            Direction::WhiteSpace,
            Direction::ParagraphSeparator,
            Direction::SegmentSeparator => false,
            default => true,
        };
    }

    /**
     * Returns `true` if the specified code point is a whitespace;
     * otherwise returns `false`.
     */
    public function codeIsWhitespace(int $codepoint): bool
    {
        if (Category::SpaceSeparator === $this->codeCategory($codepoint)) {
            return true;
        }

        return match ($this->codeDirection($codepoint)) {
            Direction::WhiteSpace,
            Direction::ParagraphSeparator,
            Direction::SegmentSeparator => true,
            default => false,
        };
    }
}
