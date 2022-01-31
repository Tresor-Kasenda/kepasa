<?php
declare(strict_types=1);

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
            $table->integer('amountSold')->default(0);
            $table->integer('ticketPrice')->default(0);
            $table->integer('ticketSold')->default(0);
            $table->integer('commission')->default(0);
            $table->integer('ticketNumber')->default(0);
            $table->foreignId('event_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('billings');
    }
};
