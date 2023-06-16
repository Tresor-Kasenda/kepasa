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
            $table->string('name');
            $table->string('last_name')->nullable();
            $table->string('phones')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->foreignId('feature_image_id')->index()->nullable();
            $table->integer('role_id')->default(RoleEnum::ROLE_USERS->value);
            $table->boolean('approval_status')->default(UserStatus::STATUS_ACTIVE->value);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
