<?php

namespace CodeSinging\PinAdmin\Facades;

use CodeSinging\PinAdmin\Foundation\Admin as FoundationAdmin;
use CodeSinging\PinAdmin\Foundation\Application;
use Illuminate\Support\Facades\Facade;

/**
 * @method static string version()
 * @method static string brand()
 * @method static string slogan()
 * @method static string label()
 * @method static Application[] applications()
 * @method static Application application(string $name = null)
 * @method static void add(string $name)
 * @method static void boot(string $name)
 * @method static string packagePath(string $path = '')
 * @method static string name()
 * @method static string directory(string $path = '')
 * @method static string path(string $path = '')
 * @method static string nameSpace(string $path = '')
 */
class Admin extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return FoundationAdmin::class;
    }
}