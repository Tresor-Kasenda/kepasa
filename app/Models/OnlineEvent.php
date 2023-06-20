<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\OnlineEvent
 *
 * @property      int $id
 * @property      int $company_id
 * @property      int $event_id
 * @property      string $room_id
 * @property      string $room_name
 * @property      string $reference
 * @property      string $moderators
 * @property      \Illuminate\Support\Carbon $schedule
 * @property      int $duration
 * @property      string $participants
 * @property      string $mode
 * @property      string $participant_id
 * @property      string $moderator
 * @property      \Illuminate\Support\Carbon|null $created_at
 * @property      \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Company $company
 * @property-read \App\Models\Event $event
 * @method        static \Illuminate\Database\Eloquent\Builder|OnlineEvent newModelQuery()
 * @method        static \Illuminate\Database\Eloquent\Builder|OnlineEvent newQuery()
 * @method        static \Illuminate\Database\Eloquent\Builder|OnlineEvent query()
 * @method        static \Illuminate\Database\Eloquent\Builder|OnlineEvent whereCompanyId($value)
 * @method        static \Illuminate\Database\Eloquent\Builder|OnlineEvent whereCreatedAt($value)
 * @method        static \Illuminate\Database\Eloquent\Builder|OnlineEvent whereDuration($value)
 * @method        static \Illuminate\Database\Eloquent\Builder|OnlineEvent whereEventId($value)
 * @method        static \Illuminate\Database\Eloquent\Builder|OnlineEvent whereId($value)
 * @method        static \Illuminate\Database\Eloquent\Builder|OnlineEvent whereMode($value)
 * @method        static \Illuminate\Database\Eloquent\Builder|OnlineEvent whereModerator($value)
 * @method        static \Illuminate\Database\Eloquent\Builder|OnlineEvent whereModerators($value)
 * @method        static \Illuminate\Database\Eloquent\Builder|OnlineEvent whereParticipantId($value)
 * @method        static \Illuminate\Database\Eloquent\Builder|OnlineEvent whereParticipants($value)
 * @method        static \Illuminate\Database\Eloquent\Builder|OnlineEvent whereReference($value)
 * @method        static \Illuminate\Database\Eloquent\Builder|OnlineEvent whereRoomId($value)
 * @method        static \Illuminate\Database\Eloquent\Builder|OnlineEvent whereRoomName($value)
 * @method        static \Illuminate\Database\Eloquent\Builder|OnlineEvent whereSchedule($value)
 * @method        static \Illuminate\Database\Eloquent\Builder|OnlineEvent whereUpdatedAt($value)
 * @mixin         \Eloquent
 */
class OnlineEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'event_id',
        'room_id',
        'room_name',
        'reference',
        'moderators',
        'schedule',
        'duration',
        'participants',
        'mode',
        'participant_id',
        'moderator',
    ];

    protected $casts = [
        'schedule' => 'datetime',
        'duration' => 'integer',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
