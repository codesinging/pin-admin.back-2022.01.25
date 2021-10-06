<?php

namespace CodeSinging\PinAdmin\Console\Commands;

use CodeSinging\PinAdmin\Console\Command;
use CodeSinging\PinAdmin\Console\PackageHelpers;
use CodeSinging\PinAdmin\Facades\Admin as AdminFacade;
use CodeSinging\PinAdmin\Foundation\Admin;

class InstallCommand extends Command
{
    use PackageHelpers;

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
        $this->createBaseDirectory();
        $this->createApplicationIndexes();
    }

    /**
     * Create the PinAdmin's base directory.
     */
    private function createBaseDirectory(): void
    {
        $this->title('Create PinAdmin directory');
        $this->makeDirectory(AdminFacade::basePath());
    }

    /**
     * Create application indexes.
     */
    private function createApplicationIndexes(): void
    {
        $this->title('Create application indexes');
        $this->createIndexes([]);
    }
}