<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * GitHub: https://github.com/codesinging
 * Create: 2021-10-07 14:56:10
 */

namespace CodeSinging\PinAdmin\Tests\Console\Commands;

use CodeSinging\PinAdmin\Console\Commands\CreateCommand;
use CodeSinging\PinAdmin\Foundation\Application;
use CodeSinging\PinAdmin\Tests\TestCase;
use Illuminate\Support\Facades\File;

class CreateCommandTest extends TestCase
{
    protected function tearDown(): void
    {
        File::deleteDirectory($this->admin()->basePath());
    }

    public function testCreate()
    {
        $this->artisan('admin:create admin');

        self::assertDirectoryExists($this->admin()->basePath());
        self::assertFileExists($this->admin()->basePath($this->admin()::INDEX_FILENAME));
        self::assertDirectoryExists($this->admin('admin')->path());
        self::assertFileExists($this->admin('admin')->path(Application::ROUTE_FILENAME));

        self::assertArrayHasKey('admin', $this->admin()->indexes());
    }
}
