<?php

declare(strict_types=1);

namespace App\Repository\Organisers\Events;

use App\Enums\PaymentEnum;
use App\Enums\RoleEnum;
use App\Enums\StatusEnum;
use App\Models\Event;
use App\Models\User;
use App\Notifications\NewAdminEventNotification;
use App\Notifications\NewEventNotification;
use App\Services\EnableX\CreateRoomService;
use App\Traits\FeedCalculation;
use App\Traits\ImageUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;

class StoreEventRepository
{
    use FeedCalculation;
    use ImageUpload;

    public function store($request): Model|Builder
    {
        $category = $this->getCategory(request: $request);
        $city = $this->getCity($request);

        $event = $this->storedEvent(
            request: $request,
            feeds: $this->resolveFeeds(
                request: $request
            ),
            category: $category,
            city: $city
        );

        if (1 === $category->id) {
            (new CreateRoomService())->handle(request: $request, event: $event);
        }

        Notification::send($event->user, new NewEventNotification($event));

        Notification::send(
            User::where('role_id', RoleEnum::ROLE_SUPER)->get(),
            new NewAdminEventNotification($event)
        );

        return $event;
    }

    private function storedEvent(
        array $request,
        array $feeds,
        Model|Builder|null $category,
        Model|Builder|null $city
    ) {
        return Event::query()
            ->create(
                [
                'user_id' => auth()->id(),
                'category_id' => $category->id,
                'city_id' => $city->id,
                'company_id' => auth()->user()->company->id,
                'title' => $request['title'],
                'event_date' => $request['event_date'],
                'start_date' => $request['start_date'],
                'end_date' => $request['end_date'],
                'address' => $request['address'],
                'ticket_number' => $request['ticket_number'],
                'prices' => $request['prices'],
                'promoted' => Event::EVENT_NOT_PROMOTED,
                'fee_option' => $request['fee_option'],
                'commission' => $feeds['0'],
                'buyer_price' => $feeds['1'],
                'description' => $request['description'],
                'status' => StatusEnum::STATUS_DEACTIVATE,
                'payment' => PaymentEnum::UNPAID
                ]
            );
    }
}
