<?php

declare(strict_types=1);

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        collect([
            "Online",
            "Presence"
        ])->each(function ($category): void {
            Category::query()->create(['name' => $category]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
