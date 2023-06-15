<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\City;
use DB;
use Illuminate\Console\Command;

class ReadSqlFileCommand extends Command
{
    protected $signature = 'sql:import';

    protected $description = 'Read sql files and persisted that in the database';

    public function handle(): void
    {
        $cities = database_path('seeders/city.sql');
        $countries = database_path('seeders/country.sql');

        if (file_exists($cities) && file_exists($countries)) {
            DB::unprepared(file_get_contents($cities));
            DB::unprepared(file_get_contents($countries));

            $cities = City::all();
            $bar = $this->output->createProgressBar(count($cities));
            $bar->start();

            foreach ($cities as $city) {
                sleep(1);
                $bar->advance($city->id);
            }

            $bar->finish();

            $this->info('The files has been imported successfully');
        } else {
            $this->error('The files does not exist');
        }
    }
}
