<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ReadSqlFileCommand extends Command
{
    protected $signature = 'sql:import';

    protected $description = 'Read sql files and read content';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $files = database_path('seeders/city.sql');

        if ( ! file_exists($files)) {
            $this->error("The files does not exists in this directory");
        }

        $content = file_get_contents($files);
    }
}
