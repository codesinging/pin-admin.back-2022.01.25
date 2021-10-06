<?php

use CodeSinging\PinAdmin\Foundation\Admin;
use Illuminate\Contracts\Foundation\Application;

if (!function_exists('admin')) {
    /**
     * @return Application|Admin
     */
    function admin(){
        return app(Admin::LABEL);
    }
}