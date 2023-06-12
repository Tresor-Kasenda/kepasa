<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use JustSteveKing\KeyFactory\Models\Concerns\HasKey;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasKey;
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'key',
        'name',
        'lastName',
        'phones',
        'role_id',
        'country_id',
        'email',
        'password',
        'status',
    ];


    public function images(): MorphMany
    {
        return $this->morphMany(Images::class, 'resource');
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function company(): HasOne
    {
        return $this->hasOne(Company::class);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function customer(): HasMany
    {
        return $this->hasMany(Customer::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function app(): HasOne
    {
        return $this->hasOne(Setting::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
