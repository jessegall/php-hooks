<?php

namespace JesseGall\Hooks\Tests;

use JesseGall\Hooks\HasHooks;
use PHPUnit\Framework\TestCase;

class HasHooksTest extends TestCase
{

    public function test__When_resolve_hooks__Then_hooks_resolved()
    {
        $subject = new class {
            use HasHooks, TestTrait;
        };

        $hooks = $subject->resolveHooks();

        $this->assertCount(2, $hooks);
    }

    public function test__When_initializeHooks__Then_hooks_initialized()
    {
        $subject = new class {
            use HasHooks, TestTrait;

            public int $count = 0;
        };

        $subject->initializeHooks();

        $this->assertEquals(2, $subject->count);
    }

}

trait TestTrait
{
    use TestTraitSub;

    public function hookTestTrait(): void
    {
        $this->count++;
    }

}

trait TestTraitSub
{

    public function hookTestTraitSub(): void
    {
        $this->count++;
    }

}