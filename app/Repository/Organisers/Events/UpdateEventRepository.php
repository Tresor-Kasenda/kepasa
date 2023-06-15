<?php

declare(strict_types=1);

namespace App\Repository\Organisers\Events;

use App\Enums\RoleEnum;
use App\Enums\StatusEnum;
use App\Http\Requests\Organiser\EventUpdateRequest;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Event;
use App\Models\User;
use App\Notifications\EventPendingApprovalNotification;
use App\Services\EnableX\CreateRoomService;
use App\Services\EnableX\EnableXHttpService;
use App\Traits\FeedCalculation;
use App\Traits\ImageUpload;
use App\Traits\RandomValue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class UpdateEventRepository
{
    use EnableXHttpService;
    use FeedCalculation;
    use ImageUpload;
    use RandomValue;

    public function handle(EventUpdateRequest $request, Event $event): Event
    {
        $category = $this->getCategory(request: $request);

        $event->fill($request->validated());

        if ($requires = $event->isDirty(['date', 'prices', 'feeOption', 'address', 'start_date', 'end_date', 'country_id'])) {
            $event->fill(['status' => StatusEnum::STATUS_DEACTIVATE]);
        }

        DB::transaction(function () use ($category, $request, $event) {

            $this->updatedEvent(
                $event,
                $request,
                $this->resolveFeeds(request: $request)
            );

            if (1 === $category->id) {
                (new CreateRoomService())->update(request: $request, event: $event);
            }
        });
        
        if ($requires) {
            Notification::send(User::where('role_id', RoleEnum::ROLE_SUPER)->first(), new EventPendingApprovalNotification($event));
        }

        return $event;
    }

    private function updatedEvent($event, $request, array $feedCalculation): void
    {
        $event->update([
            'title' => $request->input('title'),
            'sub_title' => $request->input('subTitle'),
            'date' => $request->input('date'),
            'startTime' => $request->input('startTime'),
            'endTime' => $request->input('endTime'),
            'address' => $request->input('address'),
            'ticketNumber' => $request->input('ticketNumber'),
            'prices' => $request->input('prices'),
            'feeOption' => $request->input('feeOption'),
            'commission' => $feedCalculation['0'],
            'buyerPrice' => $feedCalculation['1'],
            'country_id' => $this->getCountry($request)->id,
            'city_id' => $this->getCity($request)->id,
            'description' => $request->input('description'),
            'category_id' => $request->input('category'),
        ]);
    }

    private function getCity($request): Model|Builder|City|null
    {
        return City::query()
            ->whereCityname($request->input('cityName'))
            ->first();
    }

    private function getCountry($request): Builder|Model
    {
        return Country::query()
            ->whereCountrycode($request->input('country'))
            ->first();
    }

    private function getCategory($request): null|Builder|Model
    {
        return Category::query()
            ->where('id', '=', $request->input('category'))
            ->first();
    }
}
