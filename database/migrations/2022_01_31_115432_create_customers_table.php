<?php

declare(strict_types=1);

use App\Enums\PaymentEnum;
use App\Enums\TypeCustomer;
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
            $table->foreignIdFor(\App\Models\Event::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->enum('type', [TypeCustomer::$types])->default(TypeCustomer::USER);
            $table->string('reference')->unique();
            $table->string('ticketNumber', 9);
            $table->string('totalAmount', 9);
            $table->enum('status', [PaymentEnum::$types])->default(PaymentEnum::UNPAID);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
