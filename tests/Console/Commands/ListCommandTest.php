<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * GitHub: https://github.com/codesinging
 * Create: 2021-10-07 14:55:03
 */

namespace CodeSinging\PinAdmin\Tests\Console\Commands;

use CodeSinging\PinAdmin\Console\Commands\ListCommand;
use CodeSinging\PinAdmin\Tests\TestCase;

class ListCommandTest extends TestCase
{
    public function testCommand()
    {
        $this->artisan('admin:list')
            ->assertExitCode(0);
    }
}
