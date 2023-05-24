<?php

declare(strict_types=1);

use App\Models\City;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('city_media', function (Blueprint $table): void {
            $table->id();
            $table->string('key')->unique();
            $table->string('images');
            $table->foreignIdFor(City::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('city_media');
    }
};
