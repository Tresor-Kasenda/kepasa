<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Setting
 *
 * @property      int $id
 * @property      int $user_id
 * @property      string|null $name
 * @property      string|null $email
 * @property      string|null $copyright
 * @property      int $maintain
 * @property      \Illuminate\Support\Carbon|null $created_at
 * @property      \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method        static \Illuminate\Database\Eloquent\Builder|Setting newModelQuery()
 * @method        static \Illuminate\Database\Eloquent\Builder|Setting newQuery()
 * @method        static \Illuminate\Database\Eloquent\Builder|Setting query()
 * @method        static \Illuminate\Database\Eloquent\Builder|Setting whereCopyright($value)
 * @method        static \Illuminate\Database\Eloquent\Builder|Setting whereCreatedAt($value)
 * @method        static \Illuminate\Database\Eloquent\Builder|Setting whereEmail($value)
 * @method        static \Illuminate\Database\Eloquent\Builder|Setting whereId($value)
 * @method        static \Illuminate\Database\Eloquent\Builder|Setting whereMaintain($value)
 * @method        static \Illuminate\Database\Eloquent\Builder|Setting whereName($value)
 * @method        static \Illuminate\Database\Eloquent\Builder|Setting whereUpdatedAt($value)
 * @method        static \Illuminate\Database\Eloquent\Builder|Setting whereUserId($value)
 * @mixin         \Eloquent
 */
class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'maintain',
        'copyright'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
