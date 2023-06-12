<?php

declare(strict_types=1);

namespace App\Models;

use App\QueryBuilder\CompanyQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use JustSteveKing\KeyFactory\Models\Concerns\HasKey;

class Company extends Model
{
    use HasFactory;
    use HasKey;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function newEloquentBuilder($query): CompanyQueryBuilder
    {
        return new CompanyQueryBuilder($query);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Images::class, 'resource');
    }

    public function online(): HasMany
    {
        return $this->hasMany(OnlineEvent::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
