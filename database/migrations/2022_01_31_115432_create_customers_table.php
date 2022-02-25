<?php
declare(strict_types=1);

use App\Enums\PaymentEnum;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('name');
            $table->string('surname');
            $table->string('email');
            $table->string('phones');
            $table->string('country');
            $table->string('city');
            $table->string('ticketNumber');
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

    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
