<?php

declare(strict_types=1);

use App\Models\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Organiser']);
        Role::create(['name' => 'Customer']);
    }

    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
