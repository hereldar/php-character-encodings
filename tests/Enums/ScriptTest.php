<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings\Tests\Enums;

use Hereldar\CharacterEncodings\Enums\Script;
use Hereldar\CharacterEncodings\Tests\TestCase;
use ReflectionEnum;

final class ScriptTest extends TestCase
{
    public function testCodeAndDescription(): void
    {
        $enumReflection = new ReflectionEnum(Script::class);

        foreach (Script::cases() as $script) {
            $description = $script->description();
            $comment = $enumReflection->getCase($script->name)->getDocComment();

            if (!$description) {
                self::assertFalse($comment);
            } else {
                self::assertSame("/** {$description} */", $comment);
            }
        }
    }
}
