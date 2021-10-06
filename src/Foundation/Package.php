<?php

namespace CodeSinging\PinAdmin\Foundation;

class Package
{
    /**
     * Get the package path of PinAdmin.
     * @param string $path
     * @return string
     */
    public static function packagePath(string $path = ''): string
    {
        return dirname(__DIR__, 2) . ($path ? DIRECTORY_SEPARATOR . $path : '');
    }
}