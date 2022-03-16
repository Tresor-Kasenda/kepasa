<?php
declare(strict_types=1);

namespace App\Repository\Organisers;

use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Event;
use App\Services\EnableX\CreateRoomService;
use App\Services\EnableX\EnableXHttpService;
use App\Services\FeedCalculation;
use App\Services\ImageUpload;
use App\Services\RandomValue;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class EventOrganiserRepository
{
    use FeedCalculation, ImageUpload, RandomValue, EnableXHttpService;

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
        $event = $this->getSingleEvent(key: $key);
        return $event->load(['category', 'media', 'payments']);
    }

    public function storeEvents($attributes): Model|Builder
    {
        $feedCalculation = $this->feedCalculationEvent(attributes: $attributes);
        $category = $this->getCategory(attributes: $attributes);
        $event = $this->storeEvent(attributes: $attributes, feedCalculation: $feedCalculation);
        if ($category->id === 1){
            $online = new CreateRoomService();
            $online->storeOnlineEvent(attributes: $attributes,event: $event);
            $this->createBilling(event: $event, attributes: $attributes);
            toast("Evenement enregistrer avec succes",'success');
            return $event;
        }
        $this->createBilling(event: $event, attributes: $attributes);
        toast("Evenement enregistrer avec succes",'success');
        return $event;
    }

    public function updateEvent(string $key, $attributes): Model|Builder
    {
        $event = $this->getSingleEvent($key);
        $this->removePicture($event);
        $feedCalculation = $this->feedCalculationEvent(attributes: $attributes);
        $this->eventUpdate($event, $attributes, $feedCalculation);
        toast("Evenement a ete mise a jours",'success');
        return $event;
    }

    public function deleteEvent(string $key): Model|Builder
    {
        $event = $this->getSingleEvent(key: $key);
        $this->removePicture($event);
        $this->request()->delete(config('enablex.url')."rooms/". $event->onlineEvent->roomId);
        $event->delete();
        toast("Evenement supprimer avec succes", 'success');
        return $event;
    }

    private function getCountry($attributes): Builder|Model
    {
        return Country::query()
            ->where('countryCode', '=', $attributes->input('country'))
            ->firstOrFail();
    }

    private function getCity($attributes, $country): Builder|Model
    {
        return City::query()
            ->where('id', '=', $attributes->input('cityName'))
            ->where('countryCode', '=', $country->countryCode)
            ->firstOrFail();
    }

    private function getSingleEvent(string $key): Model|Builder
    {
        $event = Event::query()
            ->where('user_id', '=', auth()->id())
            ->where('key', '=', $key)
            ->firstOrFail();
        return $event->load('onlineEvent');
    }

    private function createBilling($event, $attributes)
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
            'billingCode' => $this->generateRandomTransaction(7)
        ]);
    }

    private function getCategory($attributes): null|Builder|Model
    {
        return Category::query()
            ->where('id', '=', $attributes->input('category_id'))
            ->first();
    }

    private function storeEvent($attributes, $feedCalculation): Builder|Model
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
                'commission' => $feedCalculation['1'],
                'buyerPrice' => $feedCalculation['2'],
                'country' => $feedCalculation['0']->countryName,
                'city' => $attributes->input('cityName'),
                'description' => $attributes->input('description'),
                'category_id' => $attributes->input('category_id'),
                'user_id' => auth()->id(),
                'image' => self::uploadFiles(request: $attributes),
                'company_id' => $attributes->user()->company->id
            ]);
    }

    private function eventUpdate($event, $attributes, array $feedCalculation): void
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
            'commission' => $feedCalculation['1'],
            'buyerPrice' => $feedCalculation['2'],
            'country' => $feedCalculation['0']->countryName,
            'city' => $attributes->input('cityName'),
            'description' => $attributes->input('description'),
            'category_id' => $attributes->input('category_id')
        ]);
    }
}
