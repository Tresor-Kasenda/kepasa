<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('lastName')->nullable();
            $table->string('phones')->unique()->nullable();
            $table->string('alternativePhones')->unique()->nullable();
            $table->string('companyName')->unique()->nullable();
            $table->string('companyWebsite')->unique()->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->timestamps();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('profiles');
    }
};
