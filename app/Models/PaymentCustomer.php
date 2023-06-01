<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Event $event
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentCustomer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentCustomer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentCustomer query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentCustomer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentCustomer whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentCustomer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentCustomer whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentCustomer whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentCustomer whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentCustomer whereTicketNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentCustomer whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentCustomer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentCustomer whereUserId($value)
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
