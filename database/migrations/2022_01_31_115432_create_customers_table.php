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
            $table->foreignIdFor(\App\Models\Event::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->string('type')->default(TypeCustomer::TYPE_USER->value);
            $table->string('reference')->unique()->nullable();
            $table->integer('ticket_number');
            $table->integer('prices');
            $table->integer('total_amount');

            $table->enum('status', [
                PaymentEnum::PAID->value,
                PaymentEnum::UNPAID->value,
            ])->default(PaymentEnum::UNPAID->value);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
