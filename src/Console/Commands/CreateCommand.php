<?php

namespace CodeSinging\PinAdmin\Console\Commands;

use CodeSinging\PinAdmin\Console\Command;
use CodeSinging\PinAdmin\Console\PackageHelpers;
use CodeSinging\PinAdmin\Exceptions\InvalidApplicationNameException;
use CodeSinging\PinAdmin\Facades\Admin as AdminFacade;
use CodeSinging\PinAdmin\Foundation\Admin;
use CodeSinging\PinAdmin\Foundation\Application;

class CreateCommand extends Command
{
    use PackageHelpers;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = Admin::LABEL . ':create {name}';

    /**
     * The console command description.
     *
     * @var string|null
     */
    protected $description = 'Create a PinAdmin application';

    /**
     * The application name.
     * @var string
     */
    protected $name;

    /**
     * The application.
     * @var Application
     */
    protected $application;

    /**
     * The applications.
     * @var array
     */
    protected $indexes = [];

    /**
     * The application structure directories
     * @var array
     */
    protected $directories = [
        'Controllers',
        'Models',
        'Middleware',
        'Requests',
        'Database'
    ];

    /**
     * Execute the console command.
     * @throws InvalidApplicationNameException
     */
    public function handle()
    {
        $this->initApplication();

        if ($this->applicationExisted()) {
            $this->error(sprintf('Application [%s] already exists', $this->name));
        } else {
            $this->createApplicationDirectories();
            $this->createApplicationRoutes();
            $this->updateApplicationIndexes();
        }
    }

    /**
     * Initialize the application.
     * @throws InvalidApplicationNameException
     */
    private function initApplication(): void
    {
        $this->indexes = AdminFacade::indexes();
        $this->name = $this->argument('name');
        $this->application = new Application($this->name);
    }

    /**
     * Determine if the application existed.
     * @return bool
     */
    private function applicationExisted(): bool
    {
        return array_key_exists($this->name, $this->indexes);
    }

    /**
     * Create application's directories.
     */
    private function createApplicationDirectories(): void
    {
        $this->title('Creating application directories');

        $this->makeDirectory($this->application->path());

        foreach ($this->directories as $directory) {
            $this->makeDirectory($this->application->path($directory));
        }
    }

    /**
     * Create application routes.
     */
    private function createApplicationRoutes(): void
    {
        $this->title('Create application routes');
        $this->copyFile(
            AdminFacade::packagePath('stubs/routes.php'),
            $this->application->path('routes.php'),
            ['__DUMMY_NAME__' => $this->name]
        );
    }

    /**
     * Update application indexes.
     */
    private function updateApplicationIndexes(): void
    {
        $this->title('Update application indexes');
        $index = [
            'name' => $this->name,
            'status' => true,
        ];
        $this->setIndex($this->name, $index);
    }
}