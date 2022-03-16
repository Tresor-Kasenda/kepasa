<?php
declare(strict_types=1);

namespace App\Repository;

use App\Enums\PaymentEnum;
use App\Enums\StatusEnum;
use App\Mail\CustomerTransactionMail;
use App\Models\Event;
use App\Traits\GetSingleEvent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class BookingRepository
{
    use GetSingleEvent;

    public function confirmedPayment($attributes)
    {
        $event = Event::query()
            ->where('title', '=', $attributes->input('title'))
            ->where('date', '=', $attributes->input('date'))
            ->when('city', fn ($query) => $query->where('city', $attributes->input('city')))
            ->where('status', '=', StatusEnum::ACTIVE)
            ->firstOrFail();

        $amount = $event->prices;
        $ref = $event->key;
        $eventName = $event->title;
        $phones = auth()->user()->phones;
        $organiserAddress = $attributes->input('address') ?? $event->address;
        $email = $attributes->input('email');
        $city = $attributes->input('city');
        $name = auth()->user()->name;
        $lastName = auth()->user()->lastName;

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
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://secure.3gdirectpay.com/API/v6/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $xml,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/xml",
                "Cookie: rguserid=e45e3da8-5247-4102-86c0-923953c408f9; rguuid=true; rgisanonymous=true; visid_incap_298628=csAjCUqUS7WWH8Wa6dzqOKXnBV8AAAAAQUIPAAAAAAAbNerQz+t/SpJMxJ9cUyxI; nlbi_298628=fKrrGq+duj9uHceGABhAXAAAAAAZHUJZ/tmZhcAICpVfTRtr; incap_ses_1018_298628=TjXibdCinUpD5oke06kgDjjsBV8AAAAASRe0dA2krSA28ITvaM8foQ=="
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $token = simplexml_load_string($response);
        $payToken = (array)$token;
        return $payToken['TransToken'];
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
        Mail::send(new CustomerTransactionMail(auth()->user(), $event));
        toast("Transaction made with success", 'success');
        return $event;
    }
}
