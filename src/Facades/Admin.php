<?php

namespace CodeSinging\PinAdmin\Facades;

use CodeSinging\PinAdmin\Foundation\Admin as FoundationAdmin;
use CodeSinging\PinAdmin\Foundation\Application;
use Illuminate\Support\Facades\Facade;

/**
 * @method static string version()
 * @method static string brand()
 * @method static string slogan()
 * @method static string label(string $suffix = '', string $separator = '_')
 * @method static Application[] applications()
 * @method static Application application(string $name = null)
 * @method static void load(string $name)
 * @method static void boot(string $name)
 * @method static string packagePath(string ...$paths)
 * @method static string basePath(string ...$paths)
 * @method static array indexes()
 * @method static boolean isInstalled()
 *
 * @method static string name()
 * @method static string directory(string ...$paths)
 * @method static string path(string ...$paths)
 * @method static string nameSpace(string ...$paths)
 * @method static string routePrefix()
 * @method static string link(string $path = '', array $parameters = [])
 */
class Admin extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return FoundationAdmin::LABEL;
    }
}