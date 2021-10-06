<?php

namespace CodeSinging\PinAdmin\Console;

use CodeSinging\PinAdmin\Facades\Admin;

trait PackageHelpers
{
    /**
     * Create application indexes.
     * @param array $indexes
     */
    public function createIndexes(array $indexes)
    {
        $this->copyFile(
            Admin::packagePath('stubs/indexes.php'),
            Admin::basePath('indexes.php'),
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
        $indexes = Admin::indexes();
        $indexes[$name] = array_merge($indexes[$name]??[], $configs);
        $this->createIndexes($indexes);
    }
}