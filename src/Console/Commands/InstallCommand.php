<?php

namespace CodeSinging\PinAdmin\Console\Commands;

use CodeSinging\PinAdmin\Console\Command;
use CodeSinging\PinAdmin\Foundation\Admin;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = Admin::LABEL . ':install';

    /**
     * The console command description.
     *
     * @var string|null
     */
    protected $description = 'Install the PinAdmin package';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->createDirectory();
        $this->createIndexes();
    }

    /**
     * Create the PinAdmin's base directory.
     */
    private function createDirectory(): void
    {
        $this->title('Create PinAdmin directory');
        $this->makeDirectory($this->basePath());
    }

    /**
     * Create application indexes.
     */
    private function createIndexes(): void
    {
        $this->title('Create application indexes');
        $this->copyFile(
            $this->packagePath('stubs/indexes.php'),
            $this->basePath('indexes.php'),
            ['__DUMMY_INDEXES__' => var_export([], true)]
        );
    }
}