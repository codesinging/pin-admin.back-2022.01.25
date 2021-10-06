<?php

namespace CodeSinging\PinAdmin\Tests\Facades;

use CodeSinging\PinAdmin\Facades\Admin;
use CodeSinging\PinAdmin\Tests\TestCase;

class AdminTest extends TestCase
{
    public function testFacade()
    {
        self::assertEquals(\CodeSinging\PinAdmin\Foundation\Admin::LABEL, Admin::label());
    }
}
