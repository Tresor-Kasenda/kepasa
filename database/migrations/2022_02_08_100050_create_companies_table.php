<?php

declare(strict_types=1);

use App\Enums\StatusEnum;
use App\Models\City;
use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(Country::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(City::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->string('company_name')->nullable();
            $table->string('address')->nullable();
            $table->string('phones')->unique()->nullable();
            $table->string('alternative_number')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('website')->unique()->nullable();
            $table->string('social_media')->unique()->nullable();
            $table->string('approval_status')->default(StatusEnum::STATUS_DEACTIVATE->value);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
