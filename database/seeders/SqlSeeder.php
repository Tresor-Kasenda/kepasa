<?php
declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SqlSeeder extends Seeder
{
    public function run()
    {
        $sql = storage_path('seeds\city.sql');
        DB::statement($sql);
    }
}
