<?php

declare(strict_types=1);

namespace App\Repository\Organisers;

use App\Models\Billing;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Event;
use App\Services\EnableX\CreateRoomService;
use App\Services\EnableX\EnableXHttpService;
use App\Traits\FeedCalculation;
use App\Traits\ImageUpload;
use App\Traits\RandomValue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use LaravelIdea\Helper\App\Models\_IH_City_QB;

class EventOrganiserRepository
{
    use EnableXHttpService;
    use FeedCalculation;
    use ImageUpload;
    use RandomValue;

    public function updateEvent(Event $event, $request): Model|Builder
    {
        $this->removePicture($event);
        $feedCalculation = $this->resolveFeeds(request: $request);
        $category = $this->getCategory(attributes: $request);

        if (1 === $category->id) {
            (new CreateRoomService())
                ->updatedBilling(event: $event, attributes: $request);

            return $event;
        }

        $this->updatedEvent($event, $request, $feedCalculation);

        return $event;
    }

    public function deletedEvent(Event $event): Model|Builder
    {
        $this->removePicture($event);
        if (null !== $event->online) {
            $this
                ->request()
                ->delete(config('enablex.url').`rooms/${$event->online->roomId}`);
        }
        $event->delete();

        return $event;
    }


    private function updatedBilling($event, $attributes): void
    {
        $amountSold = $attributes->input('ticketNumber') * $attributes->input('prices');
        $commission = (5 / 100) * $amountSold;
        $payout = $amountSold - $commission;
        $billing = Billing::query()
            ->where('event_id', '=', $event->id)
            ->first();
        $billing->update([
            'eventDate' => $event->date,
            'amountSold' => $amountSold,
            'ticketPrice' => $event->prices,
            'ticketSold' => $event->ticketNumber,
            'commission' => $commission,
            'feeType' => $attributes->input('feeOption'),
            'amountPaid' => $payout,
            'payout' => $payout,
        ]);
    }

    private function getCategory($attributes): null|Builder|Model
    {
        return Category::query()
            ->where('id', '=', $attributes->input('category'))
            ->first();
    }

    private function updatedEvent($event, $request, array $feedCalculation): void
    {
        $event->update([
            'title' => $request->input('title'),
            'subTitle' => $request->input('subTitle'),
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
            'city_id' => $this->getCity($request),
            'description' => $request->input('description'),
            'category_id' => $request->input('category'),
        ]);
    }

    private function getCity($request): Model|Builder|_IH_City_QB|City|null
    {
        return City::query()
            ->whereCityname($request->input('cityName'))
            ->first();
    }

    private function getCountry($request): Builder|Model
    {
        return Country::query()
            ->whereCountrycode( $request->input('country'))
            ->first();
    }
}
