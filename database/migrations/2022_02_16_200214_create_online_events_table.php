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
            $table->string('key')->unique();
            $table->foreignIdFor(Company::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Event::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->string('roomId')->unique();
            $table->string('roomName');
            $table->string('reference');
            $table->string('moderators');
            $table->dateTime('schedule');
            $table->string('duration');
            $table->string('participants');
            $table->string('mode', 64);
            $table->string('participantsID');
            $table->string('moderatorID');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('online_events');
    }
};
