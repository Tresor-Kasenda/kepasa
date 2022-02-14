<?php
declare(strict_types=1);

use App\Enums\FeeOptionEnum;
use App\Enums\StatusEnum;
use App\Enums\TypeEnum;
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
            $table->enum('feeOption', FeeOptionEnum::$types)->default('Inclusive');
            $table->integer('commission')->default(0);
            $table->integer('buyerPrice')->default(0);
            $table->string('country');
            $table->string('city');
            $table->longText('description')->nullable();
            $table->enum('status', StatusEnum::getValues())->default(StatusEnum::DEACTIVATE);
            $table->enum('types', TypeEnum::$types)->default('presence');
            $table->boolean('promoted')->default(0);
            $table->timestamps();

            $table->foreignId('category_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
};
