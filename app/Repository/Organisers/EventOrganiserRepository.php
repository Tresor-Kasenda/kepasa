<?php
declare(strict_types=1);

namespace App\Repository\Organisers;

use App\Mail\CreationEventMail;
use App\Models\Billing;
use App\Models\Category;
use App\Models\Country;
use App\Models\Event;
use App\Services\EnableX\CreateRoomService;
use App\Services\EnableX\EnableXHttpService;
use App\Traits\FeedCalculation;
use App\Traits\ImageUpload;
use App\Traits\RandomValue;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

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
        $event = $this->getEventByKey(key: $key);
        return $event->load(['category', 'media', 'payments']);
    }

    public function storeEvents($attributes): Model|Builder
    {
        $feedCalculation = $this->feedCalculationEvent(attributes: $attributes);
        $category = $this->getCategory(attributes: $attributes);
        $event = $this->storedEvent(attributes: $attributes, feedCalculation: $feedCalculation);

        if ($category->id === 1){
            $online = new CreateRoomService();
            $online->storeOnlineEvent(attributes: $attributes,event: $event);
            $this->createdBilling(event: $event, attributes: $attributes);
            toast("Evenement enregistrer avec succes",'success');
            return $event;
        }
        Mail::send(new CreationEventMail($event, $attributes));
        $this->createdBilling(event: $event, attributes: $attributes);
        toast("Evenement enregistrer avec succes",'success');
        return $event;
    }

    public function updateEvent(string $key, $attributes): Model|Builder
    {
        $event = $this->getEventByKey($key);
        $this->removePicture($event);
        $feedCalculation = $this->feedCalculationEvent(attributes: $attributes);
        $category = $this->getCategory(attributes: $attributes);
        if ($category->id === 1){
            $online = new CreateRoomService();
            $this->updatedBilling(event: $event, attributes: $attributes);
            toast("Evenement mise a jours avec succes",'success');
            return $event;
        }
        $this->updatedEvent($event, $attributes, $feedCalculation);
        toast("Evenement a ete mise a jours",'success');
        return $event;
    }

    public function deletedEvent(string $key): Model|Builder
    {
        $event = $this->getEventByKey(key: $key);
        $this->removePicture($event);
        if ($event->onlineEvent != null){
            $this->request()->delete(config('enablex.url')."rooms/". $event->onlineEvent->roomId);
        }
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

    private function getEventByKey(string $key): Model|Builder
    {
        $event = Event::query()
            ->where('user_id', '=', auth()->id())
            ->where('key', '=', $key)
            ->firstOrFail();
        return $event->load('onlineEvent');
    }

    private function createdBilling($event, $attributes)
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

    private function updatedBilling($event, $attributes)
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
            ->where('id', '=', $attributes->input('category_id'))
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
            'commission' => $feedCalculation['1'],
            'buyerPrice' => $feedCalculation['2'],
            'country' => $feedCalculation['0']->countryName,
            'city' => $attributes->input('cityName'),
            'description' => $attributes->input('description'),
            'category_id' => $attributes->input('category_id')
        ]);
    }
}
