<?php
declare(strict_types=1);

use App\Enums\StatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('companyName')->nullable();
            $table->string('address')->nullable();
            $table->string('phones')->unique()->nullable();
            $table->string('alternativeNumber')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('website')->unique()->nullable();
            $table->string('socialMedia')->unique()->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('activeStatus')->default(StatusEnum::ACTIVE);
            $table->string('images')->nullable();
            $table->timestamps();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('companies');
    }
};
