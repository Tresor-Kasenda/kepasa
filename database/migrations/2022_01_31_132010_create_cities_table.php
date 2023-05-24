<?php

declare(strict_types=1);

use App\Enums\CityPromotedEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('cities', function (Blueprint $table): void {
            $table->id();
            $table->string('cityName', 100)->unique();
            $table->mediumText('latitude')->nullable();
            $table->mediumText('longitude')->nullable();
            $table->mediumText('facts')->nullable();
            $table->mediumText('overview')->nullable();
            $table->string('currency', 20)->nullable();
            $table->text('history')->nullable();
            $table->string('languages')->nullable();
            $table->mediumText('population', 11)->nullable();
            $table->string('popularCity')->nullable();
            $table->mediumText('mayor')->nullable();
            $table->string('countryCode');
            $table->string('image')->nullable();
            $table->enum('promoted', [CityPromotedEnum::$cities])->default(CityPromotedEnum::NOTPROMOTED);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
