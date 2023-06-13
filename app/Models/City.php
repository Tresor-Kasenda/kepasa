<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\CityEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

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
