<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\PaymentEnum;
use App\Enums\StatusEnum;
use App\QueryBuilder\EventsOrganiserQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'user_id',
        'company_id',
        'city_id',
        'title',
        'event_date',
        'start_date',
        'end_date',
        'address',
        'ticket_number',
        'prices',
        'promoted',
        'feature_image_id',
        'fee_option',
        'commission',
        'buyer_price',
        'description',
        'status',
        'payment',
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function featuredImage(): BelongsTo
    {
        return $this->belongsTo(Images::class, 'feature_image_id');
    }

    public function images(): MorphMany
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

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
