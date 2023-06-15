<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\PaymentEnum;
use App\Enums\StatusEnum;
use App\QueryBuilder\EventsOrganiserQueryBuilder;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'user_id',
        'company_id',
        'country_id',
        'city_id',
        'feature_image_id',
        'title',
        'event_date',
        'start_date',
        'end_date',
        'address',
        'ticket_number',
        'prices',
        'fee_option',
        'commission',
        'buyer_price',
        'description',
        'status',
        'payment',
        'promoted'
    ];

    protected $casts = [
        'start_date' => 'immutable_date',
        'end_date' => 'immutable_date',
        'promoted' => 'boolean',
        'status' => StatusEnum::class,
        'ticket_number' => 'integer',
        'prices' => 'integer',
        'commission' => 'decimal',
        'buyer_price' => 'decimal',
        'payment' => PaymentEnum::class,
        'event_date' => 'immutable_date'
    ];

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

    public function featuredImage(): BelongsTo
    {
        return $this->belongsTo(Images::class, 'feature_image_id');
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
