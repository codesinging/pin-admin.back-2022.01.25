<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * GitHub: https://github.com/codesinging
 * Create: 2021-10-07 15:38:02
 */

namespace __DUMMY_NAMESPACE__\Controllers;

use CodeSinging\PinAdmin\Routing\Controller;

class IndexController extends Controller
{
    public function index(): string
    {
        dump(config('auth'));
        return __METHOD__;
    }
}