<?php

declare(strict_types=1);

use App\Enums\CityEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('cities', function (Blueprint $table): void {
            $table->id();
            $table->string('city_name', 100)->unique();
            $table->decimal('latitude', 11, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->mediumText('facts')->nullable();
            $table->string('currency', 20)->nullable();
            $table->text('history')->nullable();
            $table->string('languages')->nullable();
            $table->integer('population')->nullable();
            $table->string('popular_city')->nullable();
            $table->mediumText('mayor')->nullable();
            $table->string('country_code', 3);
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->string('promoted')->default(CityEnum::APPROVAL_NOT_PROMOTION->value);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
