<?php

namespace Hereldar\CharacterEncodings\Indexes;

use Hereldar\CharacterEncodings\Enums\Category;

class AsciiCharCategories
{
    public const INDEX = [
        "\x00" => Category::CONTROL_CHAR,
        "\x01" => Category::CONTROL_CHAR,
        "\x02" => Category::CONTROL_CHAR,
        "\x03" => Category::CONTROL_CHAR,
        "\x04" => Category::CONTROL_CHAR,
        "\x05" => Category::CONTROL_CHAR,
        "\x06" => Category::CONTROL_CHAR,
        "\x07" => Category::CONTROL_CHAR,
        "\x08" => Category::CONTROL_CHAR,
        "\x09" => Category::CONTROL_CHAR,
        "\x0a" => Category::CONTROL_CHAR,
        "\x0b" => Category::CONTROL_CHAR,
        "\x0c" => Category::CONTROL_CHAR,
        "\x0d" => Category::CONTROL_CHAR,
        "\x0e" => Category::CONTROL_CHAR,
        "\x0f" => Category::CONTROL_CHAR,
        "\x10" => Category::CONTROL_CHAR,
        "\x11" => Category::CONTROL_CHAR,
        "\x12" => Category::CONTROL_CHAR,
        "\x13" => Category::CONTROL_CHAR,
        "\x14" => Category::CONTROL_CHAR,
        "\x15" => Category::CONTROL_CHAR,
        "\x16" => Category::CONTROL_CHAR,
        "\x17" => Category::CONTROL_CHAR,
        "\x18" => Category::CONTROL_CHAR,
        "\x19" => Category::CONTROL_CHAR,
        "\x1a" => Category::CONTROL_CHAR,
        "\x1b" => Category::CONTROL_CHAR,
        "\x1c" => Category::CONTROL_CHAR,
        "\x1d" => Category::CONTROL_CHAR,
        "\x1e" => Category::CONTROL_CHAR,
        "\x1f" => Category::CONTROL_CHAR,
        "\x20" => Category::SPACE_SEPARATOR,
        "\x21" => Category::OTHER_PUNCTUATION,
        "\x22" => Category::OTHER_PUNCTUATION,
        "\x23" => Category::OTHER_PUNCTUATION,
        "\x24" => Category::CURRENCY_SYMBOL,
        "\x25" => Category::OTHER_PUNCTUATION,
        "\x26" => Category::OTHER_PUNCTUATION,
        "\x27" => Category::OTHER_PUNCTUATION,
        "\x28" => Category::OPEN_PUNCTUATION,
        "\x29" => Category::CLOSE_PUNCTUATION,
        "\x2a" => Category::OTHER_PUNCTUATION,
        "\x2b" => Category::MATH_SYMBOL,
        "\x2c" => Category::OTHER_PUNCTUATION,
        "\x2d" => Category::DASH_PUNCTUATION,
        "\x2e" => Category::OTHER_PUNCTUATION,
        "\x2f" => Category::OTHER_PUNCTUATION,
        "\x30" => Category::DECIMAL_DIGIT_NUMBER,
        "\x31" => Category::DECIMAL_DIGIT_NUMBER,
        "\x32" => Category::DECIMAL_DIGIT_NUMBER,
        "\x33" => Category::DECIMAL_DIGIT_NUMBER,
        "\x34" => Category::DECIMAL_DIGIT_NUMBER,
        "\x35" => Category::DECIMAL_DIGIT_NUMBER,
        "\x36" => Category::DECIMAL_DIGIT_NUMBER,
        "\x37" => Category::DECIMAL_DIGIT_NUMBER,
        "\x38" => Category::DECIMAL_DIGIT_NUMBER,
        "\x39" => Category::DECIMAL_DIGIT_NUMBER,
        "\x3a" => Category::OTHER_PUNCTUATION,
        "\x3b" => Category::OTHER_PUNCTUATION,
        "\x3c" => Category::MATH_SYMBOL,
        "\x3d" => Category::MATH_SYMBOL,
        "\x3e" => Category::MATH_SYMBOL,
        "\x3f" => Category::OTHER_PUNCTUATION,
        "\x40" => Category::OTHER_PUNCTUATION,
        "\x41" => Category::UPPERCASE_LETTER,
        "\x42" => Category::UPPERCASE_LETTER,
        "\x43" => Category::UPPERCASE_LETTER,
        "\x44" => Category::UPPERCASE_LETTER,
        "\x45" => Category::UPPERCASE_LETTER,
        "\x46" => Category::UPPERCASE_LETTER,
        "\x47" => Category::UPPERCASE_LETTER,
        "\x48" => Category::UPPERCASE_LETTER,
        "\x49" => Category::UPPERCASE_LETTER,
        "\x4a" => Category::UPPERCASE_LETTER,
        "\x4b" => Category::UPPERCASE_LETTER,
        "\x4c" => Category::UPPERCASE_LETTER,
        "\x4d" => Category::UPPERCASE_LETTER,
        "\x4e" => Category::UPPERCASE_LETTER,
        "\x4f" => Category::UPPERCASE_LETTER,
        "\x50" => Category::UPPERCASE_LETTER,
        "\x51" => Category::UPPERCASE_LETTER,
        "\x52" => Category::UPPERCASE_LETTER,
        "\x53" => Category::UPPERCASE_LETTER,
        "\x54" => Category::UPPERCASE_LETTER,
        "\x55" => Category::UPPERCASE_LETTER,
        "\x56" => Category::UPPERCASE_LETTER,
        "\x57" => Category::UPPERCASE_LETTER,
        "\x58" => Category::UPPERCASE_LETTER,
        "\x59" => Category::UPPERCASE_LETTER,
        "\x5a" => Category::UPPERCASE_LETTER,
        "\x5b" => Category::OPEN_PUNCTUATION,
        "\x5c" => Category::OTHER_PUNCTUATION,
        "\x5d" => Category::CLOSE_PUNCTUATION,
        "\x5e" => Category::MODIFIER_SYMBOL,
        "\x5f" => Category::CONNECTOR_PUNCTUATION,
        "\x60" => Category::MODIFIER_SYMBOL,
        "\x61" => Category::LOWERCASE_LETTER,
        "\x62" => Category::LOWERCASE_LETTER,
        "\x63" => Category::LOWERCASE_LETTER,
        "\x64" => Category::LOWERCASE_LETTER,
        "\x65" => Category::LOWERCASE_LETTER,
        "\x66" => Category::LOWERCASE_LETTER,
        "\x67" => Category::LOWERCASE_LETTER,
        "\x68" => Category::LOWERCASE_LETTER,
        "\x69" => Category::LOWERCASE_LETTER,
        "\x6a" => Category::LOWERCASE_LETTER,
        "\x6b" => Category::LOWERCASE_LETTER,
        "\x6c" => Category::LOWERCASE_LETTER,
        "\x6d" => Category::LOWERCASE_LETTER,
        "\x6e" => Category::LOWERCASE_LETTER,
        "\x6f" => Category::LOWERCASE_LETTER,
        "\x70" => Category::LOWERCASE_LETTER,
        "\x71" => Category::LOWERCASE_LETTER,
        "\x72" => Category::LOWERCASE_LETTER,
        "\x73" => Category::LOWERCASE_LETTER,
        "\x74" => Category::LOWERCASE_LETTER,
        "\x75" => Category::LOWERCASE_LETTER,
        "\x76" => Category::LOWERCASE_LETTER,
        "\x77" => Category::LOWERCASE_LETTER,
        "\x78" => Category::LOWERCASE_LETTER,
        "\x79" => Category::LOWERCASE_LETTER,
        "\x7a" => Category::LOWERCASE_LETTER,
        "\x7b" => Category::OPEN_PUNCTUATION,
        "\x7c" => Category::MATH_SYMBOL,
        "\x7d" => Category::CLOSE_PUNCTUATION,
        "\x7e" => Category::MATH_SYMBOL,
        "\x7f" => Category::CONTROL_CHAR,
    ];
}