<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * App\Models\Country
 *
 * @property      int $id
 * @property      string $country_name
 * @property      string $country_code
 * @property      string $phone_code
 * @property      Carbon|null $created_at
 * @property      Carbon|null $updated_at
 * @property-read User|null $user
 * @method        static Builder|Country newModelQuery()
 * @method        static Builder|Country newQuery()
 * @method        static Builder|Country query()
 * @method        static Builder|Country whereCountryCode($value)
 * @method        static Builder|Country whereCountryName($value)
 * @method        static Builder|Country whereCreatedAt($value)
 * @method        static Builder|Country whereId($value)
 * @method        static Builder|Country wherePhoneCode($value)
 * @method        static Builder|Country whereUpdatedAt($value)
 * @property      string|null $capital
 * @method        static Builder|Country whereCapital($value)
 * @mixin         \Eloquent
 */
class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_name',
        'country_code',
        'phone_code',
        'capital'
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
