<?php

declare(strict_types=1);

use App\Models\City;
use App\Models\Company;
use App\Models\Country;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table): void {
            $table->foreignIdFor(Company::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(City::class)
                ->constrained()
                ->cascadeOnDelete();
        });

        Schema::table('users', function (Blueprint $table): void {
            $table->foreignIdFor(Country::class)
                ->constrained()
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table): void {
        });
    }
};
