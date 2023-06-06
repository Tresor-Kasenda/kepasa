<?php

declare(strict_types=1);

namespace App\Repository\Organisers;

use App\Models\Billing;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Event;
use App\Notifications\CreatedEventNotification;
use App\Pipeline\CategoryPipe;
use App\Pipeline\FeedCalculationPipe;
use App\Pipeline\StoreEventPipe;
use App\Services\EnableX\CreateRoomService;
use App\Services\EnableX\EnableXHttpService;
use App\Traits\FeedCalculation;
use App\Traits\ImageUpload;
use App\Traits\RandomValue;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;
use LaravelIdea\Helper\App\Models\_IH_City_QB;

class EventOrganiserRepository
{
    use EnableXHttpService;
    use FeedCalculation;
    use ImageUpload;
    use RandomValue;

    protected array $pipes = [
        FeedCalculationPipe::class,
        CategoryPipe::class,
        StoreEventPipe::class
    ];

    public function getContents(): LengthAwarePaginator
    {
        return Event::query()
            ->with(['category', 'onlineEvent'])
            ->withCount('payments')
            ->where('user_id', '=', request()->user()->id)
            ->orderByDesc('created_at')
            ->paginate(6);
    }

    public function getEventById(string $key): Model|Builder
    {
        $event = $this->getEventByKey(key: $key);

        return $event->load(['category', 'media', 'payments']);
    }

    public function storeEvents($attributes): Model|Builder
    {
        $feedCalculation = $this->feedCalculationEvent(attributes: $attributes);
        $category = $this->getCategory(attributes: $attributes);
        $event = $this->storedEvent(attributes: $attributes, feedCalculation: $feedCalculation);

        if (1 === $category->id) {
            $online = new CreateRoomService();
            $online->storeOnlineEvent(attributes: $attributes, event: $event);
            $this->createdBilling(event: $event, attributes: $attributes);

            return $event;
        }

        $this->createdBilling(event: $event, attributes: $attributes);
        Notification::send(auth()->user(), new CreatedEventNotification($event));

        return $event;
    }

    public function updateEvent(string $key, $attributes): Model|Builder
    {
        $event = $this->getEventByKey($key);
        $this->removePicture($event);
        $feedCalculation = $this->feedCalculationEvent(attributes: $attributes);
        $category = $this->getCategory(attributes: $attributes);

        if (1 === $category->id) {
            $online = new CreateRoomService();
            $this->updatedBilling(event: $event, attributes: $attributes);

            return $event;
        }

        $this->updatedEvent($event, $attributes, $feedCalculation);

        return $event;
    }

    public function deletedEvent(string $key): Model|Builder
    {
        $event = $this->getEventByKey(key: $key);
        $this->removePicture($event);
        if (null !== $event->onlineEvent) {
            $this->request()->delete(config('enablex.url').'rooms/'.$event->onlineEvent->roomId);
        }
        $event->delete();

        return $event;
    }

    private function getEventByKey(string $key): Model|Builder
    {
        $event = Event::query()
            ->where('user_id', '=', auth()->id())
            ->where('key', '=', $key)
            ->firstOrFail();

        return $event->load('onlineEvent');
    }

    private function createdBilling($event, $attributes): void
    {
        $amountSold = $attributes->input('ticketNumber') * $attributes->input('prices');
        $commission = (5 / 100) * $amountSold;
        $payout = $amountSold - $commission;
        $event->billings()->create([
            'eventDate' => $event->date,
            'amountSold' => $amountSold,
            'ticketPrice' => $event->prices,
            'ticketSold' => $event->ticketNumber,
            'commission' => $commission,
            'feeType' => $attributes->input('feeOption'),
            'amountPaid' => $payout,
            'payout' => $payout,
            'outAmount' => 0,
            'user_id' => $attributes->user()->id,
            'billingCode' => $this->generateRandomTransaction(7),
        ]);
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

    private function storedEvent($attributes, $feedCalculation): Builder|Model
    {
        return Event::query()
            ->create([
                'title' => $attributes->input('title'),
                'subTitle' => $attributes->input('subTitle'),
                'date' => $attributes->input('date'),
                'startTime' => $attributes->input('startTime'),
                'endTime' => $attributes->input('endTime'),
                'address' => $attributes->input('address'),
                'ticketNumber' => $attributes->input('ticketNumber'),
                'prices' => $attributes->input('prices'),
                'feeOption' => $attributes->input('feeOption'),
                'commission' => $feedCalculation['0'],
                'buyerPrice' => $feedCalculation['1'],
                'country_id' => $this->getCountry($attributes)->id,
                'city_id' => $this->getCity($attributes)->id,
                'description' => $attributes->input('description'),
                'category_id' => $attributes->input('category'),
                'user_id' => auth()->id(),
                'image' => self::uploadFile(request: $attributes),
                'company_id' => $attributes->user()->company->id,
            ]);
    }

    private function updatedEvent($event, $attributes, array $feedCalculation): void
    {
        $event->update([
            'title' => $attributes->input('title'),
            'subTitle' => $attributes->input('subTitle'),
            'date' => $attributes->input('date'),
            'startTime' => $attributes->input('startTime'),
            'endTime' => $attributes->input('endTime'),
            'address' => $attributes->input('address'),
            'ticketNumber' => $attributes->input('ticketNumber'),
            'prices' => $attributes->input('prices'),
            'feeOption' => $attributes->input('feeOption'),
            'commission' => $feedCalculation['0'],
            'buyerPrice' => $feedCalculation['1'],
            'country_id' => $this->getCountry($attributes)->id,
            'city_id' => $this->getCity($attributes),
            'description' => $attributes->input('description'),
            'category_id' => $attributes->input('category'),
        ]);
    }

    private function getCity($attributes): Model|Builder|_IH_City_QB|City|null
    {
        return City::query()
            ->where('cityName', '=', $attributes->input('cityName'))
            ->first();
    }

    private function getCountry($attributes): Builder|Model
    {
        return Country::query()
            ->where('countryCode', '=', $attributes->input('country'))
            ->first(); 
    }
}
