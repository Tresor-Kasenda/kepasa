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
        $event = Event::query()
            ->where('id', '=', $attributes->input('key'))
            ->first();

        if (null !== $event->where('payment', PaymentEnum::PAID)->first()) {
            return $event->update([
                'status' => $attributes->input('status'),
            ]);
        }

        return false;
    }

    public function promoted(Event $event): Model|Event|Builder|null
    {
        $event = $this->getEvent($event);

        if (null !== $event) {
            $event->update(['promoted' => true]);
            toast("L'evenement a ete promus", 'success');
            return $event;
        }
        toast("L'evenement ne peut etre promus que si le paiement a ete effectuer", 'danger');
        return null;
    }

    public function unPromoted(Event $event): Event
    {
        $event->update(['promoted' => false]);
        toast("L'evenement a ete retirer de la promotion", 'success');
        return $event;
    }


    public function getEvent(Event $event): null|Builder|Event|Model
    {
        return Event::query()
            ->where('id', '=', $event->id)
            ->where('payment', '=', PaymentEnum::PAID)
            ->first();
    }
}
