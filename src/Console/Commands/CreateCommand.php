<?php

namespace CodeSinging\PinAdmin\Console\Commands;

use CodeSinging\PinAdmin\Console\Command;
use CodeSinging\PinAdmin\Exceptions\InvalidApplicationNameException;
use CodeSinging\PinAdmin\Facades\Admin as AdminFacade;
use CodeSinging\PinAdmin\Foundation\Admin;
use CodeSinging\PinAdmin\Foundation\Application;

class CreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = Admin::LABEL . ':create {name} {--P|prefix=}';

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
     * The application's route prefix.
     * @var string
     */
    protected $prefix;

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
        $this->init();

        if ($this->existed()) {
            $this->error(sprintf('Application [%s] already exists', $this->name));
        } else {
            $this->createDirectories();
            $this->createRoutes();
            $this->createControllers();
            $this->updateIndexes();
        }
    }

    /**
     * Initialize the application.
     * @throws InvalidApplicationNameException
     */
    private function init(): void
    {
        $this->indexes = AdminFacade::indexes();
        $this->name = $this->argument('name');
        $this->prefix = $this->option('prefix') ?: $this->name;
        $this->application = new Application($this->name);
    }

    /**
     * Determine if the application existed.
     * @return bool
     */
    private function existed(): bool
    {
        return array_key_exists($this->name, $this->indexes);
    }

    /**
     * Create application's directories.
     */
    private function createDirectories(): void
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
    private function createRoutes(): void
    {
        $this->title('Create application routes');
        $this->copyFile(
            AdminFacade::packagePath('stubs', Application::ROUTE_FILENAME),
            $this->application->path(Application::ROUTE_FILENAME),
            [
                '__DUMMY_LABEL__' => Admin::LABEL,
                '__DUMMY_NAME__' => $this->name,
                '__DUMMY_PREFIX__' => $this->prefix,
                '__DUMMY_NAMESPACE__' => $this->application->nameSpace(),
            ]
        );
    }

    /**
     * Create default application controllers.
     */
    private function createControllers(): void
    {
        $this->title('Create application controllers');
        $this->copyFiles(
            AdminFacade::packagePath('stubs/controllers'),
            $this->application->path('Controllers'),
            [
                '__DUMMY_NAMESPACE__' => $this->application->nameSpace(),
            ]
        );
    }

    /**
     * Update application indexes.
     */
    private function updateIndexes(): void
    {
        $this->title('Update application indexes');
        $this->indexes[$this->name] = [
            'name' => $this->name,
            'prefix' => $this->prefix,
            'status' => true,
        ];
        $this->copyFile(
            AdminFacade::packagePath('stubs', Admin::INDEX_FILENAME),
            AdminFacade::basePath(Admin::INDEX_FILENAME),
            ['__DUMMY_INDEXES__' => var_export($this->indexes, true)]
        );
    }
}