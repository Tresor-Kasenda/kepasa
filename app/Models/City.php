<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|CityMedia[] $media
 * @property-read int|null $media_count
 * @method static Builder|City newModelQuery()
 * @method static Builder|City newQuery()
 * @method static Builder|City query()
 * @method static Builder|City whereCityName($value)
 * @method static Builder|City whereCountryCode($value)
 * @method static Builder|City whereCreatedAt($value)
 * @method static Builder|City whereCurrency($value)
 * @method static Builder|City whereFacts($value)
 * @method static Builder|City whereHistory($value)
 * @method static Builder|City whereId($value)
 * @method static Builder|City whereImage($value)
 * @method static Builder|City whereLanguages($value)
 * @method static Builder|City whereLatitude($value)
 * @method static Builder|City whereLongitude($value)
 * @method static Builder|City whereMayor($value)
 * @method static Builder|City whereOverview($value)
 * @method static Builder|City wherePopularCity($value)
 * @method static Builder|City wherePopulation($value)
 * @method static Builder|City wherePromoted($value)
 * @method static Builder|City whereUpdatedAt($value)
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
