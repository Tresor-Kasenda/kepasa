<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use JustSteveKing\KeyFactory\Models\Concerns\HasKey;

class Images extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function resource(): MorphTo
    {
        return $this->morphTo();
    }
}
