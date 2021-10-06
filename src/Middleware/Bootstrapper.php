<?php

namespace CodeSinging\PinAdmin\Middleware;

use CodeSinging\PinAdmin\Facades\Admin;
use Illuminate\Http\Request;

class Bootstrapper
{
    public function handle(Request $request, \Closure $next, string $name)
    {
        Admin::boot($name);

        return $next($request);
    }
}