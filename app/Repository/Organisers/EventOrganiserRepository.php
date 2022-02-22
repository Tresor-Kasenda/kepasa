<?php
declare(strict_types=1);

namespace App\Repository\Organisers;

use App\Jobs\EventCreated;
use App\Models\Billing;
use App\Models\City;
use App\Models\Country;
use App\Models\Event;
use App\Services\FeedCalculation;
use App\Services\ImageUpload;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class EventOrganiserRepository
{
    use FeedCalculation, ImageUpload;

    public function getContents(): LengthAwarePaginator
    {
        return Event::query()
            ->with(['category', 'media'])
            ->withCount('payments')
            ->where('user_id', '=', request()->user()->id)
            ->orderByDesc('created_at')
            ->paginate(6);
    }

    public function getEventById(string $key): Model|Builder
    {
        $event = Event::query()
            ->where('key', '=', $key)
            ->where('user_id', '=', auth()->id())
            ->firstOrFail();
        return $event->load(['category', 'media', 'payments']);
    }

    public function store($attributes): Model|Builder
    {
        $feedCalculation = $this->feedCalculationEvent(attributes: $attributes);
        $event = Event::query()
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
                'commission' => $feedCalculation['2'],
                'buyerPrice' => $feedCalculation['3'],
                'country' => $feedCalculation['0']->countryName,
                'city' => $feedCalculation['1']->cityName,
                'description' => $attributes->input('description'),
                'category_id' => $attributes->input('category_id'),
                'user_id' => auth()->id(),
                'image' => self::uploadFiles(request: $attributes)
            ]);
        $this->createBilling($event, $attributes);
        dispatch(new EventCreated($event, auth()->user()->company))->delay(now()->addSecond(5));
        toast("Evenement enregistrer avec succes",'success');
        return $event;
    }

    public function updateEvent(string $key, $attributes): Model|Builder
    {
        $event = $this->getSingleEvent($key);
        $feedCalculation = $this->feedCalculationEvent(attributes: $attributes);

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
            'commission' => $feedCalculation['2'],
            'buyerPrice' => $feedCalculation['3'],
            'country' => $feedCalculation['0']->countryName,
            'city' => $feedCalculation['1']->cityName,
            'description' => $attributes->input('description'),
            'category_id' => $attributes->input('category_id')
        ]);
        toast("Evenement a ete mise a jours",'success');
        return $event;
    }

    public function deleteEvent(string $key): Model|Builder
    {
        $event = Event::query()
            ->where('user_id', '=', auth()->id())
            ->where('key', '=', $key)
            ->firstOrFail();
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
        return Event::query()
            ->where('user_id', '=', auth()->id())
            ->where('key', '=', $key)
            ->firstOrFail();
    }

    private function createBilling($event, $attributes)
    {
        $sql = <<<SQL
SELECT * FROM billings
inner join events ON events.id = billings.event_id
inner join companies ON companies.user_id = events.user_id
SQL;

        $event->billing->create([
            'eventTitle' => $attributes->input('title'),
            'eventDate' => $attributes->input('date'),
            'amountSold' => $attributes->input('title'),
            'ticketPrice' => $attributes->input('prices'),
            'ticketSold' => $attributes->input('title'),
            'commission' => $attributes->input('title'),
            'ticketNumber' => $attributes->input('title')
        ]);

//        $table->integer('amountSold')->default(0);
//        $table->integer('ticketPrice')->default(0);
//        $table->integer('ticketSold')->default(0);
//        $table->integer('commission')->default(0);
//        $table->string('feeType');
    }

}
