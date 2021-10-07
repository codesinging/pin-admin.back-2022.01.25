<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * GitHub: https://github.com/codesinging
 * Create: 2021-10-07 14:32:13
 */

namespace CodeSinging\PinAdmin\Tests\Console\Commands;

use CodeSinging\PinAdmin\Console\Commands\AdminCommand;
use CodeSinging\PinAdmin\Tests\TestCase;

class AdminCommandTest extends TestCase
{
    public function testCommand()
    {
        $this->artisan('admin')
            ->assertExitCode(0);
    }
}
