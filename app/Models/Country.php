<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use JustSteveKing\KeyFactory\Models\Concerns\HasKey;

class Country extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }

    public static function getCitiesInCountry($countryCode): Collection|array
    {
        return City::query()
            ->where('countryCode', '=', $countryCode)
            ->get();
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
