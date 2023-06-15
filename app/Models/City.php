<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\CityEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;

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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Images> $images
 * @property-read int|null $images_count
 * @method static Builder|City newModelQuery()
 * @method static Builder|City newQuery()
 * @method static Builder|City query()
 * @method static Builder|City whereCityName($value)
 * @method static Builder|City whereCountryCode($value)
 * @method static Builder|City whereCreatedAt($value)
 * @method static Builder|City whereCurrency($value)
 * @method static Builder|City whereDescription($value)
 * @method static Builder|City whereFacts($value)
 * @method static Builder|City whereHistory($value)
 * @method static Builder|City whereId($value)
 * @method static Builder|City whereImage($value)
 * @method static Builder|City whereLanguage($value)
 * @method static Builder|City whereLatitude($value)
 * @method static Builder|City whereLongitude($value)
 * @method static Builder|City whereMayor($value)
 * @method static Builder|City wherePopularCity($value)
 * @method static Builder|City wherePopulation($value)
 * @method static Builder|City wherePromoted($value)
 * @method static Builder|City whereUpdatedAt($value)
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
