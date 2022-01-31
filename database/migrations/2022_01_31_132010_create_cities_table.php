<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('cityName', 100);
            $table->mediumText('latitude');
            $table->mediumText('longitude');
            $table->string('facts')->nullable();
            $table->string('currency', 20);
            $table->string('history')->nullable();
            $table->string('language')->nullable();
            $table->string('population',11);
            $table->string('popularCity');
            $table->foreignId('countryCode')
                ->constrained('countries')
                ->cascadeOnDelete();
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('cities');
    }
};
