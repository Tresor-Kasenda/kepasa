<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * App\Models\Country
 *
 * @property int $id
 * @property string $countryName
 * @property string $countryCode
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Event[] $events
 * @property-read int|null $events_count
 *
 * @method static Builder|Country newModelQuery()
 * @method static Builder|Country newQuery()
 * @method static Builder|Country query()
 * @method static Builder|Country whereCountryCode($value)
 * @method static Builder|Country whereCountryName($value)
 * @method static Builder|Country whereCreatedAt($value)
 * @method static Builder|Country whereId($value)
 * @method static Builder|Country whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Country extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function getCitiesInCountry($countryCode): Collection|array
    {
        return City::query()
            ->where('countryCode', '=', $countryCode)
            ->get();
    }

    public function events(): HasManyThrough
    {
        return $this->hasManyThrough(
            Event::class,
            User::class,
            'country_id',
            'user_id',
            'id',
            'id'
        );
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
