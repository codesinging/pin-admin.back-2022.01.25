<?php

namespace CodeSinging\PinAdmin\Tests\Support;

use CodeSinging\PinAdmin\Foundation\Admin;
use CodeSinging\PinAdmin\Tests\TestCase;

class HelpersTest extends TestCase
{
    public function testAdmin()
    {
        self::assertInstanceOf(Admin::class, admin());
    }
}
