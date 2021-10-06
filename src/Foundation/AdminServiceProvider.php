<?php

namespace CodeSinging\PinAdmin\Foundation;

use CodeSinging\PinAdmin\Console\Commands;
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
        Commands\ListCommand::class,
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

    private function loadApplications()
    {

    }
}