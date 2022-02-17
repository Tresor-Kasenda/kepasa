<?php
declare(strict_types=1);

use App\Enums\FeeOptionEnum;
use App\Enums\PaymentEnum;
use App\Enums\StatusEnum;
use App\Enums\TypeEnum;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('title')->unique();
            $table->string('subTitle')->unique();
            $table->date('date');
            $table->time('startTime');
            $table->time('endTime');
            $table->string('address');
            $table->integer('ticketNumber')->default(0);
            $table->integer('prices')->default(0);
            $table->enum('feeOption', FeeOptionEnum::$types)
                ->default(FeeOptionEnum::Inclusive);
            $table->integer('commission')->default(0);
            $table->integer('buyerPrice')->default(0);
            $table->string('country');
            $table->string('city');
            $table->longText('description')->nullable();
            $table->enum('status', StatusEnum::$status)
                ->default(StatusEnum::DEACTIVATE);
            $table->enum('types', TypeEnum::$types)
                ->default(TypeEnum::PRESENCE);
            $table->string('payout')->nullable();
            $table->enum('payment', [PaymentEnum::UNPAID, PaymentEnum::PAID])
                ->default(PaymentEnum::UNPAID);
            $table->boolean('promoted')->default(0);
            $table->string('image');
            $table->timestamps();

            $table->foreignIdFor(Category::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
};
