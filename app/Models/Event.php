<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use JustSteveKing\KeyFactory\Models\Concerns\HasKey;

class Event extends Model
{
    use HasFactory, HasKey;

    protected $guarded = [];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function media(): HasMany
    {
        return $this->hasMany(Images::class);
    }

    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class);
    }

    public function billings(): HasMany
    {
        return $this->hasMany(Billing::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'countryCode');
    }
}
