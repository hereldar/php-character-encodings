<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings\Tests\Enums;

use Hereldar\CharacterEncodings\Enums\Direction;
use Hereldar\CharacterEncodings\Tests\TestCase;
use ReflectionEnum;

final class DirectionTest extends TestCase
{
    public function testCodeAndDescription(): void
    {
        $enumReflection = new ReflectionEnum(Direction::class);

        foreach (Direction::cases() as $direction) {
            self::assertSame(
                "/** (`{$direction->code()}`) {$direction->description()} */",
                $enumReflection->getCase($direction->name)->getDocComment(),
            );
        }
    }
}
