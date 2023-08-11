<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings\Enums;

/**
 * @internal
 */
trait IntEnumValues
{
    /**
     * @return list<int>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
