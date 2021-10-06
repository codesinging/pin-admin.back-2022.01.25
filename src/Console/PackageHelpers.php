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

    /**
     * Get the indexes of all applications.
     * @return array
     */
    public function getIndexes(): array
    {
        return include($this->basePath('indexes.php'));
    }

    /**
     * Create application indexes.
     * @param array $indexes
     */
    public function createIndexes(array $indexes)
    {
        $this->copyFile(
            $this->packagePath('stubs/indexes.php'),
            $this->basePath('indexes.php'),
            ['__DUMMY_INDEXES__' => var_export($indexes, true)]
        );
    }

    /**
     * Set an application index.
     * @param string $name
     * @param array $configs
     */
    public function setIndex(string $name, array $configs = [])
    {
        $indexes = $this->getIndexes();
        $indexes[$name] = array_merge($indexes[$name]??[], $configs);
        $this->createIndexes($indexes);
    }
}