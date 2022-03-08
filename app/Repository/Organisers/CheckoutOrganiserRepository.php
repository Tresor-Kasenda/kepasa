<?php
declare(strict_types=1);

namespace App\Repository\Organisers;

use App\Enums\PaymentEnum;
use App\Mail\PaymentConfirmationMail;
use App\Models\Event;
use App\Services\PaymentSOAP;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class CheckoutOrganiserRepository
{
    use PaymentSOAP;

    public function getCategoryByEvent($event)
    {
        return $event->load(['category', 'user']);
    }

    public function transactionWithDpo($attributes)
    {
        $event = Event::query()
            ->where('title', '=', $attributes->input('title'))
            ->where('date', '=', $attributes->input('date'))
            ->firstOrFail();

        $amount = $event->prices;
        $ref = $event->key;
        $eventName = $event->title;
        $phones = auth()->user()->phones;
        $organiserAddress = $attributes->input('address') ?? $event->address;
        $email = $attributes->input('email');
        $city = $attributes->input('city');
        $name = $attributes->input('nameOrganiser');
        $lastName = $attributes->input('lastNameOrganiser');

        $xml = "<?xml version='1.0' encoding='utf-8'?>
            <API3G>
              <CompanyToken>9F416C11-127B-4DE2-AC7F-D5710E4C5E0A</CompanyToken>
              <Request>createToken</Request>
              <Transaction>
                <PaymentAmount>" . $amount . "</PaymentAmount>
                <PaymentCurrency>USD</PaymentCurrency>
                <CompanyRef>" . $ref . "</CompanyRef>
                <RedirectURL>https://kepasa.africa/organiser/confirmation</RedirectURL>
                <BackURL>https://kepasa.africa/</BackURL>
                <customerEmail>" . $email . "</customerEmail>
                <customerFirstName>" . $name . "</customerFirstName>
                <customerLastName>" . $lastName . "</customerLastName>
                <customerAddress>" . $organiserAddress . "</customerAddress>
                <customerCity>" . $city . "</customerCity>
                <customerCountry>CD</customerCountry>
                <customerPhone>" . $phones . "</customerPhone>
                <customerZip>2189</customerZip>
              </Transaction>
              <Services>
                <Service>
                  <ServiceType>3854</ServiceType>
                  <ServiceDescription>" . $eventName . "</ServiceDescription>
                  <ServiceDate>" . date('Y/m/d h:i:s') . "</ServiceDate>
                </Service>
              </Services>
            </API3G>";
        $this->executePayment($xml);
    }

    public function updatePayment(): Model|Builder|null
    {
        $event = Event::query()
            ->where('user_id', '=', auth()->id())
            ->where('company_id', '=', auth()->user()->company->id)
            ->first();
        $event->update([
            'payment' => PaymentEnum::PAID
        ]);
        Mail::send(new PaymentConfirmationMail(auth()->user(), $event));
        toast("Transaction made with success", 'success');
        return $event;
    }
}
