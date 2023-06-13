<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\PaymentEnum;
use App\Enums\TypeCustomer;
use App\QueryBuilder\CustomerQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'user_id',
        'type',
        'reference',
        'ticket_number',
        'ticket_amount',
        'status'
    ];

    protected $casts = [
        'ticket_number' => 'integer',
        'ticket_amount' => 'integer',
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
