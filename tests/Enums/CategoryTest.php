<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings\Tests\Enums;

use Hereldar\CharacterEncodings\Enums\Category;
use Hereldar\CharacterEncodings\Tests\TestCase;
use ReflectionEnum;

final class CategoryTest extends TestCase
{
    public function testCodeAndDescription(): void
    {
        $enumReflection = new ReflectionEnum(Category::class);

        foreach (Category::cases() as $category) {
            self::assertSame(
                "/** (`{$category->code()}`) {$category->description()} */",
                $enumReflection->getCase($category->name)->getDocComment(),
            );
        }
    }
}
