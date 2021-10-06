<?php

namespace CodeSinging\PinAdmin\Foundation;

use CodeSinging\PinAdmin\Console\Commands\AdminCommand;
use CodeSinging\PinAdmin\Console\Commands\CreateCommand;
use CodeSinging\PinAdmin\Console\Commands\InstallCommand;
use CodeSinging\PinAdmin\Console\Commands\ListCommand;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * The console commands of PinAdmin.
     * @var string[]
     */
    protected $commands = [
        AdminCommand::class,
        CreateCommand::class,
        InstallCommand::class,
        ListCommand::class,
    ];

    /**
     * Register the application services of PinAdmin.
     */
    public function register()
    {
        $this->RegisterBinding();
        $this->registerCommands();
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
}