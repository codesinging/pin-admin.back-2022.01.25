<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * GitHub: https://github.com/codesinging
 * Create: 2021-10-07 15:36:09
 */

namespace CodeSinging\PinAdmin\Routing;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class Controller extends \Illuminate\Routing\Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}