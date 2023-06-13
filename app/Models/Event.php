<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\PaymentEnum;
use App\Enums\StatusEnum;
use App\QueryBuilder\EventsOrganiserQueryBuilder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Event
 *
 * @property int $id
 * @property int $category_id
 * @property int $user_id
 * @property string $title
 * @property string $sub_title
 * @property \Carbon\CarbonImmutable $start_date
 * @property \Carbon\CarbonImmutable $end_date
 * @property string $address
 * @property int $ticket_number
 * @property int $prices
 * @property string $image
 * @property string $feeOption
 * @property string $commission
 * @property string $buyer_price
 * @property string|null $description
 * @property StatusEnum $status
 * @property string|null $payout
 * @property PaymentEnum $payment
 * @property bool $promoted
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $company_id
 * @property int $country_id
 * @property int $city_id
 * @property-read Category $category
 * @property-read City $city
 * @property-read Company|null $company
 * @property-read Country $country
 * @property-read Collection<int, Customer> $customers
 * @property-read int|null $customers_count
 * @property-read Collection<int, Images> $medias
 * @property-read int|null $medias_count
 * @property-read Collection<int, OnlineEvent> $online
 * @property-read int|null $online_count
 * @property-read User $user
 * @method static EventsOrganiserQueryBuilder|Event filters(?string $filters, ?string $direction)
 * @method static EventsOrganiserQueryBuilder|Event newModelQuery()
 * @method static EventsOrganiserQueryBuilder|Event newQuery()
 * @method static EventsOrganiserQueryBuilder|Event query()
 * @method static EventsOrganiserQueryBuilder|Event search(?string $search)
 * @method static EventsOrganiserQueryBuilder|Event whereAddress($value)
 * @method static EventsOrganiserQueryBuilder|Event whereBuyerPrice($value)
 * @method static EventsOrganiserQueryBuilder|Event whereCategoryId($value)
 * @method static EventsOrganiserQueryBuilder|Event whereCityId($value)
 * @method static EventsOrganiserQueryBuilder|Event whereCommission($value)
 * @method static EventsOrganiserQueryBuilder|Event whereCompanyId($value)
 * @method static EventsOrganiserQueryBuilder|Event whereCountryId($value)
 * @method static EventsOrganiserQueryBuilder|Event whereCreatedAt($value)
 * @method static EventsOrganiserQueryBuilder|Event whereDescription($value)
 * @method static EventsOrganiserQueryBuilder|Event whereEndDate($value)
 * @method static EventsOrganiserQueryBuilder|Event whereFeeOption($value)
 * @method static EventsOrganiserQueryBuilder|Event whereId($value)
 * @method static EventsOrganiserQueryBuilder|Event whereImage($value)
 * @method static EventsOrganiserQueryBuilder|Event wherePayment($value)
 * @method static EventsOrganiserQueryBuilder|Event wherePayout($value)
 * @method static EventsOrganiserQueryBuilder|Event wherePrices($value)
 * @method static EventsOrganiserQueryBuilder|Event wherePromoted($value)
 * @method static EventsOrganiserQueryBuilder|Event whereStartDate($value)
 * @method static EventsOrganiserQueryBuilder|Event whereStatus($value)
 * @method static EventsOrganiserQueryBuilder|Event whereSubTitle($value)
 * @method static EventsOrganiserQueryBuilder|Event whereTicketNumber($value)
 * @method static EventsOrganiserQueryBuilder|Event whereTitle($value)
 * @method static EventsOrganiserQueryBuilder|Event whereUpdatedAt($value)
 * @method static EventsOrganiserQueryBuilder|Event whereUserId($value)
 * @mixin \Eloquent
 */
class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'user_id',
        'company_id',
        'country_id',
        'city_id',
        'title',
        'sub_title',
        'start_date',
        'end_date',
        'address',
        'ticket_number',
        'prices',
        'image',
        'feeOption',
        'commission',
        'buyer_price',
        'description',
        'status',
        'payout',
        'payment',
        'promoted',
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
