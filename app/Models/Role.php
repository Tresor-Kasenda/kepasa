<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use JustSteveKing\KeyFactory\Models\Concerns\HasKey;

class Role extends Model
{
    use HasFactory, HasKey;

    protected $guarded = [];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
