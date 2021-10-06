<?php

namespace CodeSinging\PinAdmin\Console;

use CodeSinging\PinAdmin\Foundation\Admin;

trait PackageHelpers
{
    /**
     * The base path of the PinAdmin applications.
     * @param string $path
     * @return string
     */
    protected function basePath(string $path = ''): string
    {
        return app_path(Admin::DIRECTORY . ($path ? DIRECTORY_SEPARATOR . $path : ''));
    }

    /**
     * Get the package path of PinAdmin.
     * @param string $path
     * @return string
     */
    public function packagePath(string $path = ''): string
    {
        return dirname(__DIR__, 2) . ($path ? DIRECTORY_SEPARATOR . $path : '');
    }
}