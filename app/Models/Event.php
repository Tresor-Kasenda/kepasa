<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\PaymentEnum;
use App\Enums\StatusEnum;
use App\QueryBuilder\EventsOrganiserQueryBuilder;
use Carbon\CarbonImmutable;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Event
 *
 * @property      int $id
 * @property      int $category_id
 * @property      int $user_id
 * @property      string $title
 * @property      CarbonImmutable $event_date
 * @property      CarbonImmutable $start_date
 * @property      CarbonImmutable $end_date
 * @property      string $address
 * @property      int $ticket_number
 * @property      int $prices
 * @property      bool $promoted
 * @property      int|null $feature_image_id
 * @property      string $fee_option
 * @property      string $commission
 * @property      string $buyer_price
 * @property      string|null $description
 * @property      StatusEnum $status
 * @property      PaymentEnum $payment
 * @property      Carbon|null $created_at
 * @property      Carbon|null $updated_at
 * @property      Carbon|null $deleted_at
 * @property      int $company_id
 * @property      int $city_id
 * @property-read Category $category
 * @property-read City $city
 * @property-read Company|null $company
 * @property-read Collection<int, Customer> $customers
 * @property-read int|null $customers_count
 * @property-read Images|null $featuredImage
 * @property-read Collection<int, Images> $images
 * @property-read int|null $images_count
 * @property-read Collection<int, OnlineEvent> $online
 * @property-read int|null $online_count
 * @property-read User $user
 * @method        static EventsOrganiserQueryBuilder|Event filters(?string $filters, ?string $direction)
 * @method        static EventsOrganiserQueryBuilder|Event newModelQuery()
 * @method        static EventsOrganiserQueryBuilder|Event newQuery()
 * @method        static Builder|Event onlyTrashed()
 * @method        static EventsOrganiserQueryBuilder|Event query()
 * @method        static EventsOrganiserQueryBuilder|Event search(?string $search)
 * @method        static EventsOrganiserQueryBuilder|Event whereAddress($value)
 * @method        static EventsOrganiserQueryBuilder|Event whereBuyerPrice($value)
 * @method        static EventsOrganiserQueryBuilder|Event whereCategoryId($value)
 * @method        static EventsOrganiserQueryBuilder|Event whereCityId($value)
 * @method        static EventsOrganiserQueryBuilder|Event whereCommission($value)
 * @method        static EventsOrganiserQueryBuilder|Event whereCompanyId($value)
 * @method        static EventsOrganiserQueryBuilder|Event whereCreatedAt($value)
 * @method        static EventsOrganiserQueryBuilder|Event whereDeletedAt($value)
 * @method        static EventsOrganiserQueryBuilder|Event whereDescription($value)
 * @method        static EventsOrganiserQueryBuilder|Event whereEndDate($value)
 * @method        static EventsOrganiserQueryBuilder|Event whereEventDate($value)
 * @method        static EventsOrganiserQueryBuilder|Event whereFeatureImageId($value)
 * @method        static EventsOrganiserQueryBuilder|Event whereFeeOption($value)
 * @method        static EventsOrganiserQueryBuilder|Event whereId($value)
 * @method        static EventsOrganiserQueryBuilder|Event wherePayment($value)
 * @method        static EventsOrganiserQueryBuilder|Event wherePrices($value)
 * @method        static EventsOrganiserQueryBuilder|Event wherePromoted($value)
 * @method        static EventsOrganiserQueryBuilder|Event whereStartDate($value)
 * @method        static EventsOrganiserQueryBuilder|Event whereStatus($value)
 * @method        static EventsOrganiserQueryBuilder|Event whereTicketNumber($value)
 * @method        static EventsOrganiserQueryBuilder|Event whereTitle($value)
 * @method        static EventsOrganiserQueryBuilder|Event whereUpdatedAt($value)
 * @method        static EventsOrganiserQueryBuilder|Event whereUserId($value)
 * @method        static Builder|Event withTrashed()
 * @method        static Builder|Event withoutTrashed()
 * @mixin         Eloquent
 */
class Event extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const EVENT_PROMOTED = 1;
    public const EVENT_NOT_PROMOTED = 0;

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
