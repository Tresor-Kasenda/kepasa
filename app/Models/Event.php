<?php

declare(strict_types=1);

namespace App\Models;

use App\QueryBuilder\EventsOrganiserQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use JustSteveKing\KeyFactory\Models\Concerns\HasKey;

class Event extends Model
{
    use HasFactory;
    use HasKey;

    protected $guarded = [];

    public function newEloquentBuilder($query): EventsOrganiserQueryBuilder
    {
        return new EventsOrganiserQueryBuilder($query);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getEventImages(): string
    {
        return asset('storage/'.$this->image);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function medias(): MorphMany
    {
        return $this->morphMany(Images::class, 'resource');
    }

    public function online(): HasMany
    {
        return $this->hasMany(OnlineEvent::class);
    }

    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
