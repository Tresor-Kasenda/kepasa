<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
