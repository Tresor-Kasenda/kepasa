<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use JustSteveKing\KeyFactory\Models\Concerns\HasKey;

/**
 * App\Models\Billing
 *
 * @property int $id
 * @property string $key
 * @property int $event_id
 * @property int $user_id
 * @property string $billingCode
 * @property string $eventDate
 * @property string $amountSold
 * @property string $ticketPrice
 * @property string $ticketSold
 * @property string $commission
 * @property string $feeType
 * @property string $amountPaid
 * @property string $payout
 * @property string $outAmount
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Event $event
 * @property-read User $user
 *
 * @method static Builder|Billing newModelQuery()
 * @method static Builder|Billing newQuery()
 * @method static Builder|Billing query()
 * @method static Builder|Billing whereAmountPaid($value)
 * @method static Builder|Billing whereAmountSold($value)
 * @method static Builder|Billing whereBillingCode($value)
 * @method static Builder|Billing whereCommission($value)
 * @method static Builder|Billing whereCreatedAt($value)
 * @method static Builder|Billing whereEventDate($value)
 * @method static Builder|Billing whereEventId($value)
 * @method static Builder|Billing whereFeeType($value)
 * @method static Builder|Billing whereId($value)
 * @method static Builder|Billing whereKey($value)
 * @method static Builder|Billing whereOutAmount($value)
 * @method static Builder|Billing wherePayout($value)
 * @method static Builder|Billing whereTicketPrice($value)
 * @method static Builder|Billing whereTicketSold($value)
 * @method static Builder|Billing whereUpdatedAt($value)
 * @method static Builder|Billing whereUserId($value)
 *
 * @mixin \Eloquent
 */
class Billing extends Model
{
    use HasFactory;
    use HasKey;

    protected $guarded = [];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
