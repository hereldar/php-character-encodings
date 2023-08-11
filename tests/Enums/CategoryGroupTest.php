<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings\Tests\Enums;

use Hereldar\CharacterEncodings\Enums\CategoryGroup;
use Hereldar\CharacterEncodings\Tests\TestCase;
use ReflectionEnum;

final class CategoryGroupTest extends TestCase
{
    public function testCodeAndDescription(): void
    {
        $enumReflection = new ReflectionEnum(CategoryGroup::class);

        foreach (CategoryGroup::cases() as $categoryGroup) {
            self::assertSame(
                "/** (`{$categoryGroup->code()}`) {$categoryGroup->description()} */",
                $enumReflection->getCase($categoryGroup->name)->getDocComment(),
            );
        }
    }
}
