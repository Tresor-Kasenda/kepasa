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
 * App\Models\CityMedia
 *
 * @property int $id
 * @property string $key
 * @property string $images
 * @property int $city_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read City $city
 * @method static Builder|CityMedia newModelQuery()
 * @method static Builder|CityMedia newQuery()
 * @method static Builder|CityMedia query()
 * @method static Builder|CityMedia whereCityId($value)
 * @method static Builder|CityMedia whereCreatedAt($value)
 * @method static Builder|CityMedia whereId($value)
 * @method static Builder|CityMedia whereImages($value)
 * @method static Builder|CityMedia whereKey($value)
 * @method static Builder|CityMedia whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CityMedia extends Model
{
    use HasFactory;
    use HasKey;

    protected $guarded = [];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
