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

        Category::query()
            ->create([
                'name' => 'Event Online',
            ]);
        Category::query()
            ->create([
                'name' => 'Event Presence',
            ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
