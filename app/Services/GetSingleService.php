<?php
declare(strict_types=1);

namespace App\Services;

use App\Enums\PaymentEnum;
use App\Enums\StatusEnum;
use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait GetSingleService
{
    public function getEventByKey(string $key): Model|Builder|null
    {
        return Event::query()
            ->where('key', '=', $key)
            ->where('payment', '=', PaymentEnum::PAID)
            ->where('status', '=', StatusEnum::ACTIVE)
            ->first();
    }
}
