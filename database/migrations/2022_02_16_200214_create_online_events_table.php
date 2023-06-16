<?php

declare(strict_types=1);

use App\Models\Company;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('online_events', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(Company::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Event::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->string('room_id')->unique();
            $table->string('room_name');
            $table->string('reference');
            $table->string('moderators');
            $table->dateTime('schedule');
            $table->integer('duration');
            $table->string('participants');
            $table->string('mode', 64);
            $table->string('participant_id');
            $table->string('moderator');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('online_events');
    }
};
