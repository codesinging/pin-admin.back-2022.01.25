<?php

namespace CodeSinging\PinAdmin\Tests;

use CodeSinging\PinAdmin\Foundation\Admin;
use CodeSinging\PinAdmin\Foundation\AdminServiceProvider;
use Illuminate\Contracts\Foundation\Application;

class TestCase extends \Orchestra\Testbench\TestCase
{

    protected function getPackageProviders($app): array
    {
        return [AdminServiceProvider::class];
    }

    /**
     * @return Application|Admin
     */
    protected function admin(string $name = '')
    {
        $admin = app(Admin::LABEL);
        if ($name) {
            $admin->boot($name);
        }
        return $admin;
    }
}