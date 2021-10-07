<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * GitHub: https://github.com/codesinging
 * Create: 2021-10-06 16:59:27
 */

use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'admin.guest:__DUMMY_NAME__'])
    ->prefix('__DUMMY_PREFIX__')
    ->group(function () {
        Route::get('/login', [__DUMMY_NAMESPACE__\Controllers\LoginController::class, 'index']);
    });

Route::middleware(['web', 'admin.auth:__DUMMY_NAME__,__DUMMY_LABEL_____DUMMY_NAME__'])
    ->prefix('__DUMMY_PREFIX__')
    ->group(function () {
        Route::get('/', [__DUMMY_NAMESPACE__\Controllers\IndexController::class, 'index']);
    });