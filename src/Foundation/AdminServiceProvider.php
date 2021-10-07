<?php

namespace CodeSinging\PinAdmin\Foundation;

use CodeSinging\PinAdmin\Console\Commands;
use CodeSinging\PinAdmin\Facades\Admin as AdminFacade;
use CodeSinging\PinAdmin\Middleware\Bootstrapper;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * The console commands of PinAdmin.
     * @var string[]
     */
    protected $commands = [
        Commands\AdminCommand::class,
        Commands\ApplicationsCommand::class,
        Commands\CreateCommand::class,
        Commands\EnableCommand::class,
        Commands\ListCommand::class,
        Commands\DisableCommand::class,
    ];

    /**
     * The middlewares of PinAdmin applications.
     * @var string[]
     */
    protected $middlewares = [
        'admin.boot' => Bootstrapper::class,
    ];

    /**
     * The middleware groups of PinAdmin applications.
     * @var array
     */
    protected $middlewareGroups = [
        'admin' => [],
    ];

    /**
     * Register the application services of PinAdmin.
     */
    public function register()
    {
        $this->RegisterBinding();
        $this->registerCommands();
        $this->registerMiddlewares();
    }

    /**
     * Bootstrap the application services of PinAdmin
     */
    public function boot()
    {
        $this->loadApplications();
        $this->loadRoutes();
    }

    /**
     * Register the binding to the container.
     */
    private function RegisterBinding(): void
    {
        $this->app->singleton(Admin::LABEL, Admin::class);
    }

    /**
     * Register PinAdmin's console commands.
     */
    private function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands($this->commands);
        }
    }

    /**
     * Register middleware for the application routes
     */
    private function registerMiddlewares(): void
    {
        /** @var Router $router */
        $router = $this->app['router'];

        foreach ($this->middlewares as $key => $middleware) {
            $router->aliasMiddleware($key, $middleware);
        }

        foreach ($this->middlewareGroups as $key => $middlewareGroup) {
            $router->middlewareGroup($key, $middlewareGroup);
        }
    }

    /**
     * Load all applications.
     */
    private function loadApplications(): void
    {
        $applications = AdminFacade::indexes();
        foreach ($applications as $name => $application) {
            if ($application['status']) {
                AdminFacade::add($name);
            }
        }
    }

    /**
     * Load routes of all applications.
     */
    private function loadRoutes(): void
    {
        $applications = AdminFacade::applications();
        foreach ($applications as $application) {
            $this->loadRoutesFrom($application->path(Application::ROUTE_FILENAME));
        }
    }
}