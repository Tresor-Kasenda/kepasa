<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\StatusEnum;
use App\QueryBuilder\CompanyQueryBuilder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Company
 *
 * @property      int $id
 * @property      int $user_id
 * @property      int $country_id
 * @property      int $city_id
 * @property      string|null $company_name
 * @property      string|null $address
 * @property      string|null $phones
 * @property      string|null $alternative_number
 * @property      string|null $email
 * @property      string|null $website
 * @property      string|null $social_media
 * @property      StatusEnum $approval_status
 * @property      Carbon|null $created_at
 * @property      Carbon|null $updated_at
 * @property-read Collection<int, Event> $events
 * @property-read int|null $events_count
 * @property-read Collection<int, Images> $images
 * @property-read int|null $images_count
 * @property-read User $user
 * @method        static CompanyQueryBuilder|Company newModelQuery()
 * @method        static CompanyQueryBuilder|Company newQuery()
 * @method        static CompanyQueryBuilder|Company query()
 * @method        static CompanyQueryBuilder|Company search(?string $search)
 * @method        static CompanyQueryBuilder|Company whereAddress($value)
 * @method        static CompanyQueryBuilder|Company whereAlternativeNumber($value)
 * @method        static CompanyQueryBuilder|Company whereApprovalStatus($value)
 * @method        static CompanyQueryBuilder|Company whereCityId($value)
 * @method        static CompanyQueryBuilder|Company whereCompanyName($value)
 * @method        static CompanyQueryBuilder|Company whereCountryId($value)
 * @method        static CompanyQueryBuilder|Company whereCreatedAt($value)
 * @method        static CompanyQueryBuilder|Company whereEmail($value)
 * @method        static CompanyQueryBuilder|Company whereId($value)
 * @method        static CompanyQueryBuilder|Company wherePhones($value)
 * @method        static CompanyQueryBuilder|Company whereSocialMedia($value)
 * @method        static CompanyQueryBuilder|Company whereUpdatedAt($value)
 * @method        static CompanyQueryBuilder|Company whereUserId($value)
 * @method        static CompanyQueryBuilder|Company whereWebsite($value)
 * @mixin         \Eloquent
 */
class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'country_id',
        'city_id',
        'company_name',
        'address',
        'phone',
        'email',
        'website',
        'alternative_phone',
        'social_media',
        'approval_status',
    ];

    protected $casts = [
        'approval_status' => StatusEnum::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function newEloquentBuilder($query): CompanyQueryBuilder
    {
        return new CompanyQueryBuilder($query);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Images::class, 'resource');
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
