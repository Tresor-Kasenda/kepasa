<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use JustSteveKing\KeyFactory\Models\Concerns\HasKey;

class Company extends Model
{
    use HasFactory, HasKey;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function onlineEvents(): HasMany
    {
        return $this->hasMany(OnlineEvent::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
