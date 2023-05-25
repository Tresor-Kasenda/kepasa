<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use JustSteveKing\KeyFactory\Models\Concerns\HasKey;

/**
 * App\Models\Company
 *
 * @property int $id
 * @property string $key
 * @property string|null $companyName
 * @property string|null $address
 * @property string|null $phones
 * @property string|null $alternativeNumber
 * @property string|null $email
 * @property string|null $website
 * @property string|null $socialMedia
 * @property string|null $country
 * @property string|null $city
 * @property string $activeStatus
 * @property string|null $images
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $user_id
 * @property-read Collection|Event[] $events
 * @property-read int|null $events_count
 * @property-read Collection|OnlineEvent[] $onlineEvents
 * @property-read int|null $online_events_count
 * @property-read User $user
 *
 * @method static Builder|Company newModelQuery()
 * @method static Builder|Company newQuery()
 * @method static Builder|Company query()
 * @method static Builder|Company whereActiveStatus($value)
 * @method static Builder|Company whereAddress($value)
 * @method static Builder|Company whereAlternativeNumber($value)
 * @method static Builder|Company whereCity($value)
 * @method static Builder|Company whereCompanyName($value)
 * @method static Builder|Company whereCountry($value)
 * @method static Builder|Company whereCreatedAt($value)
 * @method static Builder|Company whereEmail($value)
 * @method static Builder|Company whereId($value)
 * @method static Builder|Company whereImages($value)
 * @method static Builder|Company whereKey($value)
 * @method static Builder|Company wherePhones($value)
 * @method static Builder|Company whereSocialMedia($value)
 * @method static Builder|Company whereUpdatedAt($value)
 * @method static Builder|Company whereUserId($value)
 * @method static Builder|Company whereWebsite($value)
 *
 * @mixin \Eloquent
 */
class Company extends Model
{
    use HasFactory;
    use HasKey;

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
