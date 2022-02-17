<?php
declare(strict_types=1);

use App\Enums\PaymentEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payment_customers', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->foreignIdFor(\App\Models\Event::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->string('username');
            $table->string('surName');
            $table->string('email');
            $table->string('phones');
            $table->integer('ticketNumber');
            $table->integer('totalAmount')->default(0);
            $table->string('reference')->unique();
            $table->enum('status', [PaymentEnum::$types])->default(PaymentEnum::UNPAID);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_customers');
    }
};
