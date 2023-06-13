<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use JustSteveKing\KeyFactory\Models\Concerns\HasKey;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function event(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
