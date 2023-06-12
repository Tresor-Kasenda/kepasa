<?php

declare(strict_types=1);

namespace App\Models;

use App\QueryBuilder\CustomerQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JustSteveKing\KeyFactory\Models\Concerns\HasKey;

class Customer extends Model
{
    use HasFactory;
    use HasKey;

    protected $fillable = [
        'event_id',
        'user_id',
        'type',
        'reference',
        'ticketNumber',
        'totalAmount',
        'status'
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
