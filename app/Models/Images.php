<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;
use Eloquent;

/**
 * App\Models\Images
 *
 * @property      int $id
 * @property      string $resource_type
 * @property      int $resource_id
 * @property      string $path
 * @property      Carbon|null $created_at
 * @property      Carbon|null $updated_at
 * @property-read Model|Eloquent $resource
 * @method        static Builder|Images newModelQuery()
 * @method        static Builder|Images newQuery()
 * @method        static Builder|Images query()
 * @method        static Builder|Images whereCreatedAt($value)
 * @method        static Builder|Images whereId($value)
 * @method        static Builder|Images whereKey($value)
 * @method        static Builder|Images wherePath($value)
 * @method        static Builder|Images whereResourceId($value)
 * @method        static Builder|Images whereResourceType($value)
 * @method        static Builder|Images whereUpdatedAt($value)
 * @mixin         Eloquent
 */
class Images extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function resource(): MorphTo
    {
        return $this->morphTo();
    }
}
