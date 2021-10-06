<?php

namespace CodeSinging\PinAdmin\Console\Commands;

use CodeSinging\PinAdmin\Console\Command;
use CodeSinging\PinAdmin\Foundation\Admin;

class ApplicationsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = Admin::LABEL . ':applications';

    /**
     * The console command description.
     *
     * @var string|null
     */
    protected $description = 'List all PinAdmin applications';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->listApplications();
    }

    /**
     * List all applications.
     */
    private function listApplications(): void
    {
        $this->title('All the PinAdmin applications');
        $indexes = $this->getIndexes();
        $data = [];
        foreach ($indexes as $application) {
            $data[] = [count($data) + 1, $application['name'], $application['status'] ? 'true' : 'false'];
        }
        $this->table(['Index', 'Name', 'Status'], $data);
    }
}