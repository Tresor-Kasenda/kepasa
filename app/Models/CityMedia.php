<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JustSteveKing\KeyFactory\Models\Concerns\HasKey;

/**
 * App\Models\CityMedia
 *
 * @property int $id
 * @property string $key
 * @property string $images
 * @property int $city_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\City $city
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CityMedia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CityMedia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CityMedia query()
 * @method static \Illuminate\Database\Eloquent\Builder|CityMedia whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CityMedia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CityMedia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CityMedia whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CityMedia whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CityMedia whereUpdatedAt($value)
 *
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
