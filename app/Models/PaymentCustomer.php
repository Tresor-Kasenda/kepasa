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
 * App\Models\PaymentCustomer
 *
 * @property int $id
 * @property string $key
 * @property int $event_id
 * @property int $user_id
 * @property string $ticketNumber
 * @property string $totalAmount
 * @property string $reference
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Event $event
 * @property-read User $user
 * @method static Builder|PaymentCustomer newModelQuery()
 * @method static Builder|PaymentCustomer newQuery()
 * @method static Builder|PaymentCustomer query()
 * @method static Builder|PaymentCustomer whereCreatedAt($value)
 * @method static Builder|PaymentCustomer whereEventId($value)
 * @method static Builder|PaymentCustomer whereId($value)
 * @method static Builder|PaymentCustomer whereKey($value)
 * @method static Builder|PaymentCustomer whereReference($value)
 * @method static Builder|PaymentCustomer whereStatus($value)
 * @method static Builder|PaymentCustomer whereTicketNumber($value)
 * @method static Builder|PaymentCustomer whereTotalAmount($value)
 * @method static Builder|PaymentCustomer whereUpdatedAt($value)
 * @method static Builder|PaymentCustomer whereUserId($value)
 * @mixin \Eloquent
 */
class PaymentCustomer extends Model
{
    use HasFactory;
    use HasKey;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
