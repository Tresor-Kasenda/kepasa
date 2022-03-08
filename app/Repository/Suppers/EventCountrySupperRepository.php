<?php
declare(strict_types=1);

namespace App\Repository\Suppers;

use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class EventCountrySupperRepository
{
    public function getContents()
    {
        $getCountries = DB::select('SELECT DISTINCT cities.cityName, countryname FROM events
    INNER JOIN cities ON cities.cityName = events.city
    INNER JOIN countries ON countries.countrycode = cities.countryCode');
        $countEvents = [];
        foreach ($getCountries as $country){
            $countEvents = DB::select('SELECT COUNT(*) FROM events where city = ?', [$country->cityName]);
        }
        return $getCountries;
    }

}
