<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * GitHub: https://github.com/codesinging
 * Create: 2021-10-07 15:21:07
 */

namespace CodeSinging\PinAdmin\Tests\Console\Commands;

use CodeSinging\PinAdmin\Foundation\Admin;
use CodeSinging\PinAdmin\Tests\TestCase;
use Illuminate\Support\Facades\File;

class DisableAndEnableCommandTest extends TestCase
{
    protected function tearDown(): void
    {
        File::deleteDirectory($this->admin()->basePath());
    }

    public function testCommand()
    {
        $this->artisan('admin:create admin')->run();

        $indexes = include($this->admin()->basePath(Admin::INDEX_FILENAME));
        self::assertTrue($indexes['admin']['status']);

        $this->artisan('admin:disable admin')->run();

        $indexes = include($this->admin()->basePath(Admin::INDEX_FILENAME));
        self::assertFalse($indexes['admin']['status']);

        $this->artisan('admin:enable admin')->run();

        $indexes = include($this->admin()->basePath(Admin::INDEX_FILENAME));
        self::assertTrue($indexes['admin']['status']);
    }
}
