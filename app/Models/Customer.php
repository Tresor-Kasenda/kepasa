<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\PaymentEnum;
use App\Enums\TypeCustomer;
use App\QueryBuilder\CustomerQueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Customer
 *
 * @property      int $id
 * @property      int $event_id
 * @property      int $user_id
 * @property      TypeCustomer $type
 * @property      string|null $reference
 * @property      int $ticket_number
 * @property      int $total_amount
 * @property      PaymentEnum $status
 * @property      Carbon|null $created_at
 * @property      Carbon|null $updated_at
 * @property      Carbon|null $deleted_at
 * @property-read \App\Models\Event $event
 * @property-read \App\Models\User $user
 * @method        static CustomerQueryBuilder|Customer newModelQuery()
 * @method        static CustomerQueryBuilder|Customer newQuery()
 * @method        static Builder|Customer onlyTrashed()
 * @method        static CustomerQueryBuilder|Customer query()
 * @method        static CustomerQueryBuilder|Customer search(?string $search)
 * @method        static CustomerQueryBuilder|Customer sortBy(?string $sortBy, ?string $direction)
 * @method        static CustomerQueryBuilder|Customer whereCreatedAt($value)
 * @method        static CustomerQueryBuilder|Customer whereDeletedAt($value)
 * @method        static CustomerQueryBuilder|Customer whereEventId($value)
 * @method        static CustomerQueryBuilder|Customer whereId($value)
 * @method        static CustomerQueryBuilder|Customer whereReference($value)
 * @method        static CustomerQueryBuilder|Customer whereStatus($value)
 * @method        static CustomerQueryBuilder|Customer whereTicketNumber($value)
 * @method        static CustomerQueryBuilder|Customer whereTotalAmount($value)
 * @method        static CustomerQueryBuilder|Customer whereType($value)
 * @method        static CustomerQueryBuilder|Customer whereUpdatedAt($value)
 * @method        static CustomerQueryBuilder|Customer whereUserId($value)
 * @method        static Builder|Customer withTrashed()
 * @method        static Builder|Customer withoutTrashed()
 * @mixin         \Eloquent
 */
class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'event_id',
        'user_id',
        'type',
        'reference',
        'ticket_number',
        'total_amount',
        'prices',
        'status'
    ];

    protected $casts = [
        'ticket_number' => 'integer',
        'total_amount' => 'integer',
        'prices' => 'integer',
        'status' => PaymentEnum::class,
        'type' => TypeCustomer::class,
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function newEloquentBuilder($query): CustomerQueryBuilder
    {
        return new CustomerQueryBuilder($query);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
