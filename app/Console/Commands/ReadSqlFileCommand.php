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
        $cities = database_path('seeders/city.sql');
        $countries = database_path('seeders/country.sql');

        if ( ! file_exists($cities) && ! file_exists($countries)) {
            $this->error("The files does not exists in this directory");
        }
    }
}
