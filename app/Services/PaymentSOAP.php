<?php
declare(strict_types=1);

namespace App\Services;

trait PaymentSOAP
{
    public function executePayment($xml)
    {
        try {
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
        } catch (\Exception $exception){
            return $exception->getMessage();
        }
    }
}
