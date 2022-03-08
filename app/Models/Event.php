<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use JustSteveKing\KeyFactory\Models\Concerns\HasKey;

/**
 * App\Models\Event
 *
 * @property int $id
 * @property string $key
 * @property string $title
 * @property string $subTitle
 * @property string $date
 * @property string $startTime
 * @property string $endTime
 * @property string $address
 * @property int $ticketNumber
 * @property int $prices
 * @property string $feeOption
 * @property string $commission
 * @property string $buyerPrice
 * @property \App\Models\Country|null $country
 * @property string $city
 * @property string|null $description
 * @property string $status
 * @property string|null $payout
 * @property string $payment
 * @property int $promoted
 * @property string $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $category_id
 * @property int $user_id
 * @property int $company_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Billing[] $billings
 * @property-read int|null $billings_count
 * @property-read \App\Models\Category $category
 * @property-read \App\Models\Company $company
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Customer[] $customers
 * @property-read int|null $customers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Images[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OnlineEvent[] $onlineEvent
 * @property-read int|null $online_event_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PaymentCustomer[] $payments
 * @property-read int|null $payments_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event query()
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereBuyerPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereFeeOption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event wherePayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event wherePayout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event wherePrices($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event wherePromoted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereSubTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereTicketNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUserId($value)
 * @mixin \Eloquent
 */
class Event extends Model
{
    use HasFactory, HasKey;

    protected $guarded = [];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function media(): HasMany
    {
        return $this->hasMany(Images::class);
    }

    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class);
    }

    public function billings(): HasMany
    {
        return $this->hasMany(Billing::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'countryCode');
    }

    public function onlineEvent(): HasMany
    {
        return $this->hasMany(OnlineEvent::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(PaymentCustomer::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
