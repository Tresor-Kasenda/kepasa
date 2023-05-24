<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
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
 * @property Country|null $country
 * @property string $city
 * @property string|null $description
 * @property string $status
 * @property string|null $payout
 * @property string $payment
 * @property int $promoted
 * @property string $image
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $category_id
 * @property int $user_id
 * @property int $company_id
 * @property-read Collection|Billing[] $billings
 * @property-read int|null $billings_count
 * @property-read Category $category
 * @property-read Company $company
 * @property-read int|null $customers_count
 * @property-read Collection|Images[] $media
 * @property-read int|null $media_count
 * @property-read Collection|OnlineEvent[] $onlineEvent
 * @property-read int|null $online_event_count
 * @property-read Collection|Customer[] $payments
 * @property-read int|null $payments_count
 * @property-read User $user
 *
 * @method static Builder|Event newModelQuery()
 * @method static Builder|Event newQuery()
 * @method static Builder|Event query()
 * @method static Builder|Event whereAddress($value)
 * @method static Builder|Event whereBuyerPrice($value)
 * @method static Builder|Event whereCategoryId($value)
 * @method static Builder|Event whereCity($value)
 * @method static Builder|Event whereCommission($value)
 * @method static Builder|Event whereCompanyId($value)
 * @method static Builder|Event whereCountry($value)
 * @method static Builder|Event whereCreatedAt($value)
 * @method static Builder|Event whereDate($value)
 * @method static Builder|Event whereDescription($value)
 * @method static Builder|Event whereEndTime($value)
 * @method static Builder|Event whereFeeOption($value)
 * @method static Builder|Event whereId($value)
 * @method static Builder|Event whereImage($value)
 * @method static Builder|Event whereKey($value)
 * @method static Builder|Event wherePayment($value)
 * @method static Builder|Event wherePayout($value)
 * @method static Builder|Event wherePrices($value)
 * @method static Builder|Event wherePromoted($value)
 * @method static Builder|Event whereStartTime($value)
 * @method static Builder|Event whereStatus($value)
 * @method static Builder|Event whereSubTitle($value)
 * @method static Builder|Event whereTicketNumber($value)
 * @method static Builder|Event whereTitle($value)
 * @method static Builder|Event whereUpdatedAt($value)
 * @method static Builder|Event whereUserId($value)
 *
 * @mixin \Eloquent
 */
class Event extends Model
{
    use HasFactory;
    use HasKey;

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

    public function billings(): HasMany
    {
        return $this->hasMany(Billing::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'countryCode');
    }

    public function onlineEvent(): HasOne
    {
        return $this->hasOne(OnlineEvent::class);
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
