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
 * App\Models\Images
 *
 * @property int $id
 * @property string $key
 * @property string|null $image
 * @property int $event_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $company_id
 *
 * @property-read Company $company
 * @property-read Event $event
 *
 * @method static Builder|Images newModelQuery()
 * @method static Builder|Images newQuery()
 * @method static Builder|Images query()
 * @method static Builder|Images whereCompanyId($value)
 * @method static Builder|Images whereCreatedAt($value)
 * @method static Builder|Images whereEventId($value)
 * @method static Builder|Images whereId($value)
 * @method static Builder|Images whereImage($value)
 * @method static Builder|Images whereKey($value)
 * @method static Builder|Images whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Images extends Model
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
}
