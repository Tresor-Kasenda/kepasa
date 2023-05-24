<?php

declare(strict_types=1);

use App\Enums\PaymentEnum;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table): void {
            $table->id();
            $table->string('key')->unique();
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('email')->nullable();
            $table->string('phones')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('reference')->unique();
            $table->string('ticketNumber', 9);
            $table->string('totalAmount', 9);
            $table->enum('status', [PaymentEnum::$types])->default(PaymentEnum::UNPAID);
            $table->foreignIdFor(\App\Models\Event::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
