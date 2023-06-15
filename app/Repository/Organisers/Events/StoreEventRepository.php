<?php

declare(strict_types=1);

namespace App\Repository\Organisers\Events;

use App\Http\Requests\Organiser\StoreEventRequest;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Notifications\CreatedEventNotification;
use App\Services\EnableX\CreateRoomService;
use App\Traits\FeedCalculation;
use App\Traits\ImageUpload;
use App\Traits\RandomValue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class StoreEventRepository
{
    use FeedCalculation;
    use ImageUpload;
    use RandomValue;

    public function store(StoreEventRequest $request): Model|Builder
    {
        $category = $this->getCategory(request: $request);

        DB::transaction(function () use ($category, $request) {
            $event = $this->storedEvent(
                request: Arr::except($request->validated(), ['category', 'country']),
                feeds: $this->resolveFeeds(
                    request: $request
                )
            );

            if (1 === $category->id) {
                (new CreateRoomService())->handle(request: $request, event: $event);
            }

            Notification::send(auth()->user(), new CreatedEventNotification($event));

            return $event;
        });
    }

    private function getCategory($request): null|Builder|Model
    {
        return Category::query()
            ->where('id', '=', $request->input('category'))
            ->first();
    }

    private function storedEvent($request, $feeds): Builder|Model
    {
        return auth()->user()
            ->events()
            ->create([
                'title' => $request->input('title'),
                'sub_title' => $request->input('subTitle'),
                'date' => $request->input('date'),
                'start_date' => $request->input('startTime'),
                'end_date' => $request->input('endTime'),
                'address' => $request->input('address'),
                'ticket_number' => $request->input('ticketNumber'),
                'prices' => $request->input('prices'),
                'feeOption' => $request->input('feeOption'),
                'commission' => $feeds['0'],
                'buyer_price' => $feeds['1'],
                'country_id' => $this->getCountry($request)->id,
                'city_id' => $this->getCity($request)->id,
                'description' => $request->input('description'),
                'category_id' => $request->input('category'),
                'image' => self::uploadFile(request: $request),
                'company_id' => auth()->user()->company->id,
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
}
