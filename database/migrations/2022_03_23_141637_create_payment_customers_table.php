<?php

declare(strict_types=1);

use App\Enums\PaymentEnum;
use App\Models\Event as EventAlias;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('payment_customers', function (Blueprint $table): void {
            $table->id();
            $table->string('key')->unique();
            $table->foreignIdFor(EventAlias::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->string('ticketNumber');
            $table->string('totalAmount');
            $table->string('reference')->unique();
            $table->enum('status', [PaymentEnum::$types])->default(PaymentEnum::UNPAID);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_customers');
    }
};
