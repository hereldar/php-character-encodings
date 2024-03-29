<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings\Enums;

/**
 * @internal
 */
trait StringEnumValues
{
    /**
     * @return list<string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
