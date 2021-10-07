<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * GitHub: https://github.com/codesinging
 * Create: 2021-10-07 14:36:14
 */

namespace CodeSinging\PinAdmin\Tests\Console\Commands;

use CodeSinging\PinAdmin\Console\Commands\ApplicationsCommand;
use CodeSinging\PinAdmin\Tests\TestCase;

class ApplicationsCommandTest extends TestCase
{
    public function testCommand()
    {
        $this->artisan('admin:applications')
            ->assertExitCode(0);
    }
}
