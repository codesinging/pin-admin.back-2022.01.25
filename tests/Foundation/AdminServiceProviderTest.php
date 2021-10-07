<?php

namespace CodeSinging\PinAdmin\Tests\Foundation;

use CodeSinging\PinAdmin\Foundation\Admin;
use CodeSinging\PinAdmin\Tests\TestCase;

class AdminServiceProviderTest extends TestCase
{
    public function testRegisterBinding()
    {
        self::assertInstanceOf(Admin::class, app(Admin::LABEL));
    }

    public function testSingleton()
    {
        self::assertEquals(app(Admin::LABEL), app(Admin::LABEL));
    }
}
