<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JustSteveKing\KeyFactory\Models\Concerns\HasKey;

/**
 * App\Models\OnlineEvent
 *
 * @property int $id
 * @property string $key
 * @property int $company_id
 * @property int $event_id
 * @property string $roomId
 * @property string $roomName
 * @property string $reference
 * @property string $moderators
 * @property string $schedule
 * @property string $mode
 * @property string $participantsID
 * @property string $moderatorID
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Company $company
 * @property-read \App\Models\Event $event
 *
 * @method static Builder|OnlineEvent newModelQuery()
 * @method static Builder|OnlineEvent newQuery()
 * @method static Builder|OnlineEvent query()
 * @method static Builder|OnlineEvent whereCompanyId($value)
 * @method static Builder|OnlineEvent whereCreatedAt($value)
 * @method static Builder|OnlineEvent whereEventId($value)
 * @method static Builder|OnlineEvent whereId($value)
 * @method static Builder|OnlineEvent whereKey($value)
 * @method static Builder|OnlineEvent whereMode($value)
 * @method static Builder|OnlineEvent whereModeratorID($value)
 * @method static Builder|OnlineEvent whereModerators($value)
 * @method static Builder|OnlineEvent whereParticipantsID($value)
 * @method static Builder|OnlineEvent whereReference($value)
 * @method static Builder|OnlineEvent whereRoomId($value)
 * @method static Builder|OnlineEvent whereRoomName($value)
 * @method static Builder|OnlineEvent whereSchedule($value)
 * @method static Builder|OnlineEvent whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class OnlineEvent extends Model
{
    use HasFactory;
    use HasKey;

    protected $guarded = [];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public static function getOnlineEvents($key): Model|Builder|null
    {
        return OnlineEvent::query()
            ->select('*')
            ->join('events', 'events.id', '=', 'online_events.event_id')
            ->where('events.user_id', auth()->id())
            ->where('events.id', $key)
            ->first();
    }
}
