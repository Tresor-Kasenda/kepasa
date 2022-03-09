<?php
declare(strict_types=1);

namespace App\Repository\Suppers;

use App\Enums\PaymentEnum;
use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class StatusEventRepository
{
    public function changeStatus($attributes): bool|int
    {
        $event = $this->getEvent($attributes);

        return $event->update([
            'status' => $attributes->input('status')
        ]);
    }

    public function promoted(string $key): Model|Event|Builder|null
    {
        $event = $this->getSingleEvent($key);
        $event->update([
            'promoted' => true
        ]);
        toast("L'evenement a ete promus", 'success');
        return $event;
    }

    public function unPromoted(string $key): Model|Event|Builder|null
    {
        $event = $this->getSingleEvent($key);
        $event->update([
            'promoted' => false
        ]);
        toast("L'evenement a ete retirer de la promotion", 'success');
        return $event;
    }

    private function getEvent($attributes): null|Builder|Event|Model
    {
        return Event::query()
            ->where('key', '=', $attributes->input('key'))
            ->where('payment', '=', PaymentEnum::PAID)
            ->first();
    }

    private function getSingleEvent(string $key): null|Builder|Event|Model
    {
        return Event::query()
            ->where('key', '=', $key)
            ->where('payment', '=', PaymentEnum::PAID)
            ->first();
    }
}
