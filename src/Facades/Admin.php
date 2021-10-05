<?php

namespace CodeSinging\PinAdmin\Facades;

use CodeSinging\PinAdmin\Foundation\Admin as FoundationAdmin;
use Illuminate\Support\Facades\Facade;

/**
 * @method static string version()
 * @method static string brand()
 * @method static string slogan()
 * @method static string label()
 */
class Admin extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return FoundationAdmin::class;
    }
}