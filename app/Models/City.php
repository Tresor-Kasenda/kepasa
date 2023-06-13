<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\CityEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * App\Models\City
 *
 * @property int $id
 * @property string $city_name
 * @property string|null $latitude
 * @property string|null $longitude
 * @property string|null $facts
 * @property string|null $currency
 * @property string|null $history
 * @property string|null $language
 * @property int|null $population
 * @property string|null $popular_city
 * @property string|null $mayor
 * @property string $country_code
 * @property string|null $image
 * @property string|null $description
 * @property CityEnum $promoted
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Images> $images
 * @property-read int|null $images_count
 * @method static \Illuminate\Database\Eloquent\Builder|City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City query()
 * @method static \Illuminate\Database\Eloquent\Builder|City whereCityName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereFacts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereHistory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereMayor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City wherePopularCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City wherePopulation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City wherePromoted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_name',
        'latitude',
        'longitude',
        'facts',
        'currency',
        'history',
        'language',
        'population',
        'popular_city',
        'mayor',
        'country_code',
        'image',
        'description',
        'promoted',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'population' => 'integer',
        'promoted' => CityEnum::class
    ];

    public function images(): MorphMany
    {
        return $this->morphMany(Images::class, 'resource');
    }
}
