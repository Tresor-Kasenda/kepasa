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
 * App\Models\Category
 *
 * @property      int $id
 * @property      string $name
 * @property      Carbon|null $created_at
 * @property      Carbon|null $updated_at
 * @property-read Collection<int, Event> $event
 * @property-read int|null $event_count
 * @method        static Builder|Category newModelQuery()
 * @method        static Builder|Category newQuery()
 * @method        static Builder|Category query()
 * @method        static Builder|Category whereCreatedAt($value)
 * @method        static Builder|Category whereId($value)
 * @method        static Builder|Category whereName($value)
 * @method        static Builder|Category whereUpdatedAt($value)
 * @mixin         \Eloquent
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function event(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
