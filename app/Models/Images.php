<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * App\Models\Images
 *
 * @property int $id
 * @property string $key
 * @property string $resource_type
 * @property int $resource_id
 * @property string $path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Model|\Eloquent $resource
 * @method static \Illuminate\Database\Eloquent\Builder|Images newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Images newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Images query()
 * @method static \Illuminate\Database\Eloquent\Builder|Images whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Images whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Images whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Images wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Images whereResourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Images whereResourceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Images whereUpdatedAt($value)
 * @mixin \Eloquent
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
