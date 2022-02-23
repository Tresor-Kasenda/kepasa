<?php
declare(strict_types=1);

use App\Enums\FeeOptionEnum;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('billings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->foreignIdFor(\App\Models\Event::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->date('eventDate');
            $table->string('amountSold', 9);
            $table->string('ticketPrice', 9);
            $table->string('ticketSold', 9);
            $table->string('commission', 9);
            $table->string('feeType');
            $table->string('amountPaid', 9);
            $table->string('payout', 9);
            $table->string('outAmount', 9);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('billings');
    }
};
