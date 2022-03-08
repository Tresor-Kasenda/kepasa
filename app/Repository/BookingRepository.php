<?php
declare(strict_types=1);

namespace App\Repository;

use App\Models\Event;
use App\Services\GetSingleService;
use App\Services\PaymentSOAP;

class BookingRepository
{
    use GetSingleService, PaymentSOAP;

    public function confirmedPayment($attributes)
    {
        $event = Event::query()
            ->where('title', '=', $attributes->input('title'))
            ->where('date', '=', $attributes->input('date'))
            ->firstOrFail();

        $xml = "<?xml version='1.0' encoding='utf-8'?>
        <API3G>
            <CompanyToken>9F416C11-127B-4DE2-AC7F-D5710E4C5E0A</CompanyToken>
            <Request>createToken</Request>
            <Transaction>
              <PaymentAmount>".$_POST['amountDue']."</PaymentAmount>
              <PaymentCurrency>USD</PaymentCurrency>
              <CompanyRef>".$_POST['ref']."</CompanyRef>
              <RedirectURL>https://kepasa.africa/confirmP.php</RedirectURL>
              <BackURL>https://kepasa.africa/back/deleteCustomer.php</BackURL>
              <customerEmail>".$_POST['email']."</customerEmail>
              <customerFirstName>".$_POST['customerName']."</customerFirstName>
              <customerLastName>".$_POST['customerLastname']."</customerLastName>
              <customerAddress>99 Oxford Road, Saxonworld 2198, Johannesburg, South Africa</customerAddress>
              <customerCity>Johannesburg</customerCity>
              <customerCountry>ZA</customerCountry>
              <customerPhone>".$_POST['contact']."</customerPhone>
              <customerZip>2198</customerZip>
            </Transaction>
            <Services>
                <Service>
                    <ServiceType>3854</ServiceType>
                    <ServiceDescription>".$_POST['eventName']."</ServiceDescription>
                    <ServiceDate>".date('Y/m/d h:i:s',strtotime($_POST['eventDate'].' '.$_POST['startTime']))."</ServiceDate>
                </Service>
            </Services>
        </API3G>";
        $this->executePayment($xml);
    }
}
