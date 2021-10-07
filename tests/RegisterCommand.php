<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * GitHub: https://github.com/codesinging
 * Create: 2021-10-07 14:47:19
 */

namespace CodeSinging\PinAdmin\Tests;

use Illuminate\Console\Application;

trait RegisterCommand
{
    /**
     * Register a temporary artisan command.
     * @param string $command
     */
    protected function registerCommand(string $command)
    {
        Application::starting(function (Application $application) use ($command){
            $application->add(app($command));
        });
    }
}