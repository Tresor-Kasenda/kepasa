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
 * App\Models\Customer
 *
 * @property int $id
 * @property string $key
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string $phones
 * @property string $country
 * @property string $city
 * @property string $ticketNumber
 * @property string $status
 * @property int $event_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Event $event
 * @property-read User $user
 * @method static Builder|Customer newModelQuery()
 * @method static Builder|Customer newQuery()
 * @method static Builder|Customer query()
 * @method static Builder|Customer whereCity($value)
 * @method static Builder|Customer whereCountry($value)
 * @method static Builder|Customer whereCreatedAt($value)
 * @method static Builder|Customer whereEmail($value)
 * @method static Builder|Customer whereEventId($value)
 * @method static Builder|Customer whereId($value)
 * @method static Builder|Customer whereKey($value)
 * @method static Builder|Customer whereName($value)
 * @method static Builder|Customer wherePhones($value)
 * @method static Builder|Customer whereStatus($value)
 * @method static Builder|Customer whereSurname($value)
 * @method static Builder|Customer whereTicketNumber($value)
 * @method static Builder|Customer whereUpdatedAt($value)
 * @method static Builder|Customer whereUserId($value)
 * @mixin \Eloquent
 */
class Customer extends Model
{
    use HasFactory, HasKey;

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
