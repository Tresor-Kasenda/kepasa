<?php

declare(strict_types=1);

use App\Enums\RoleEnum;
use App\Enums\UserStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table): void {
            $table->id();
            $table->string('key')->unique();
            $table->string('name');
            $table->string('lastName')->nullable();
            $table->string('phones')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('role_id')->default(RoleEnum::SUPER);
            $table->boolean('status')->default(UserStatus::ACTIVE);
            $table->string('images')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
