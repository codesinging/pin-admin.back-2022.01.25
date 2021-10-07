<?php

namespace CodeSinging\PinAdmin\Foundation;

use CodeSinging\PinAdmin\Console\Commands;
use CodeSinging\PinAdmin\Facades\Admin as AdminFacade;
use CodeSinging\PinAdmin\Middleware\Bootstrapper;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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
    }

    /**
     * Bootstrap the application services of PinAdmin
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerCommands();
            $this->publishResources();
            $this->registerMigrations();
        }
        if (!$this->app->configurationIsCached()) {
            $this->mergeConfiguration();
            $this->configureAuth();
        }
        $this->registerMiddlewares();
        $this->loadRoutes();
        $this->loadViews();
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
        $this->commands($this->commands);
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
     * Load routes of all applications.
     */
    private function loadRoutes(): void
    {
        if (!$this->app->routesAreCached()) {
            $applications = AdminFacade::applications();
            foreach ($applications as $application) {
                $this->loadRoutesFrom($application->path(Application::ROUTE_FILENAME));
            }
        }
    }

    /**
     * Publish application resources.
     */
    private function publishResources(): void
    {

    }

    /**
     * Register application migrations.
     */
    private function registerMigrations(): void
    {

    }

    /**
     * Load common application views.
     */
    private function loadViews(): void
    {

    }

    /**
     * Merge application configuration.
     */
    private function mergeConfiguration(): void
    {
        $this->mergeConfigFrom(AdminFacade::packagePath('config/admin.php'), AdminFacade::label());
    }

    /**
     * Set the application's auth configuration.
     */
    private function configureAuth(): void
    {
        $applications = AdminFacade::applications();
        foreach ($applications as $name => $application) {
            config([
                'auth.guards.' . AdminFacade::label($name) => [
                    'driver' => 'session',
                    'provider' => $name . '_users',
                ],
                'auth.providers.' . $name . '_users' => [
                    'driver' => 'eloquent',
                    'model' => 'App\\Models\\' . Str::studly($name . '_users')
                ]
            ]);
        }
    }
}