<?php

namespace CodeSinging\PinAdmin\Foundation;

use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register the application services of PinAdmin.
     */
    public function register()
    {
        $this->app->singleton(Admin::LABEL, Admin::class);
    }

    /**
     * Bootstrap the application services of PinAdmin
     */
    public function boot()
    {

    }
}