<?php
declare(strict_types=1);

namespace App\Repository\Organisers;

use App\Models\City;
use App\Models\Country;
use App\Models\Event;
use App\Services\FeedCalculation;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class EventOrganiserRepository
{
    use FeedCalculation;

    public function getContents(): LengthAwarePaginator
    {
        return Event::query()
            ->with(['category', 'media'])
            ->withCount('billings')
            ->where('user_id', '=', request()->user()->id)
            ->orderByDesc('created_at')
            ->paginate(1);
    }

    public function getEventById(string $key): Model|Builder
    {
        $event = Event::query()
            ->where('key', '=', $key)
            ->firstOrFail();
        return $event->load(['category', 'media', 'billings']);
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
                'user_id' => auth()->id()
            ]);
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
            ->where('key', '=', $key)
            ->firstOrFail();
    }
}
