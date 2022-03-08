<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * App\Models\City
 *
 * @property int $id
 * @property string $cityName
 * @property string|null $latitude
 * @property string|null $longitude
 * @property string|null $facts
 * @property string|null $overview
 * @property string|null $currency
 * @property string|null $history
 * @property string|null $languages
 * @property string|null $population
 * @property string|null $popularCity
 * @property string|null $mayor
 * @property string $countryCode
 * @property string|null $image
 * @property string $promoted
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CityMedia[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City query()
 * @method static \Illuminate\Database\Eloquent\Builder|City whereCityName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereFacts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereHistory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereLanguages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereMayor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereOverview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City wherePopularCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City wherePopulation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City wherePromoted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class City extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function media(): HasMany
    {
        return $this->hasMany(CityMedia::class);
    }
}
