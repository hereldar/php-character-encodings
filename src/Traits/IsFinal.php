<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings\Traits;

trait IsFinal
{
    private static self $instance;

    public static function encoding(): static
    {
        return self::$instance ??= new self();
    }
}
