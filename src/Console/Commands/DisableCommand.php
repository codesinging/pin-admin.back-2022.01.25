<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * GitHub: https://github.com/codesinging
 * Create: 2021-10-06 18:10:10
 */

namespace CodeSinging\PinAdmin\Console\Commands;

use CodeSinging\PinAdmin\Console\Command;
use CodeSinging\PinAdmin\Facades\Admin as AdminFacade;
use CodeSinging\PinAdmin\Foundation\Admin;

class DisableCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = Admin::LABEL . ':disable {name}';

    /**
     * The console command description.
     *
     * @var string|null
     */
    protected $description = 'Disable a PinAdmin application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->title('Stop application');

        $name = $this->argument('name');
        $indexes = AdminFacade::indexes();

        if (array_key_exists($name, $indexes)) {
            $indexes[$name]['status'] = false;
            $this->copyFile(
                AdminFacade::packagePath('stubs/indexes.php'),
                AdminFacade::basePath('indexes.php'),
                ['__DUMMY_INDEXES__' => var_export($indexes, true)]
            );
        } else {
            $this->warn(sprintf('Application [%s] does not exist', $name));
        }
    }
}