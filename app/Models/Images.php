<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use JustSteveKing\KeyFactory\Models\Concerns\HasKey;

class Images extends Model
{
    use HasFactory, HasKey;

    protected $guarded = [];

    public function model(): MorphTo
    {
        return $this->morphTo();
    }
}
