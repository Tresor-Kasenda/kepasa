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
            $table->string('eventTitle');
            $table->integer('amountSold')->default(0);
            $table->integer('ticketPrice')->default(0);
            $table->integer('ticketSold')->default(0);
            $table->integer('commission')->default(0);
            $table->string('feeType');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('billings');
    }
};
