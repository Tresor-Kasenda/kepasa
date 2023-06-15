<?php

declare(strict_types=1);

use App\Enums\FeeOptionEnum;
use App\Enums\PaymentEnum;
use App\Enums\StatusEnum;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(Category::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->string('title')->unique();
            $table->date('event_date');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('address');
            $table->integer('ticket_number');
            $table->integer('prices');
            $table->foreignId('feature_image_id')->index()->nullable();
            $table->enum('fee_option', FeeOptionEnum::$types)
                ->default(FeeOptionEnum::Inclusive);
            $table->decimal('commission')->default(0);
            $table->decimal('buyer_price')->default(0);
            $table->longText('description')->nullable();
            $table->tinyInteger('status')->default(StatusEnum::STATUS_DEACTIVATE->value);
            $table->enum('payment', [PaymentEnum::UNPAID->value, PaymentEnum::PAID->value])
                ->default(PaymentEnum::UNPAID->value);
            $table->boolean('promoted')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
