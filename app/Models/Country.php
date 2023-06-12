<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Country extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function events(): HasManyThrough
    {
        return $this->hasManyThrough(
            Event::class,
            User::class,
            'country_id',
            'user_id',
            'id',
            'id'
        );
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
