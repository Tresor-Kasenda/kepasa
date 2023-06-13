<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JustSteveKing\KeyFactory\Models\Concerns\HasKey;

class OnlineEvent extends Model
{
    use HasFactory;

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
