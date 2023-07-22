<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings;

if (!function_exists('str_represent')) {
    /**
     * Returns a parsable string representation of the given string.
     *
     * Differs from {@see var_export()} in that non-printable
     * characters are escaped using hexadecimal notation.
     *
     * Multibyte characters are split and represented byte by byte.
     *
     * @phpstan-pure
     * @psalm-pure
     */
    function str_represent(string $str): string
    {
        $result = '';

        for ($i = 0, $length = strlen($str); $i < $length; ++$i) {
            $char = $str[$i];
            if ('"' === $char) {
                $result .= '\"';
            } elseif ('\\' === $char) {
                $result .= '\\\\';
            } elseif (ctype_print($char)) {
                $result .= $char;
            } else {
                $result .= sprintf('\\x%02X', ord($char));
            }
        }

        return "\"{$result}\"";
    }
}
