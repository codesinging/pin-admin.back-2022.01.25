<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * GitHub: https://github.com/codesinging
 * Create: 2021-10-06 16:59:27
 */

use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'admin.boot:__DUMMY_NAME__', 'admin'])
    ->prefix('__DUMMY_PREFIX__')
    ->group(function(){
        Route::get('/', function (){
            return admin()->name();
        });
    });