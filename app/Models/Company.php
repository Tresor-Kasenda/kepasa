<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\StatusEnum;
use App\QueryBuilder\CompanyQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'country_id',
        'city_id',
        'company_name',
        'address',
        'phone',
        'email',
        'website',
        'alternative_phone',
        'social_media',
        'approval_status',
    ];

    protected $casts = [
        'approval_status' => StatusEnum::class,
    ];

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

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
