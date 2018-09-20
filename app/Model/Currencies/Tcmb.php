<?php

namespace App\Model\Currencies;

use GuzzleHttp\Client;

class Tcmb
{
    private $url = 'http://www.tcmb.gov.tr/kurlar/today.xml';

    private $currencies;

    public function __construct()
    {
        $this->currencies = Currency::all();
    }

    private function getSource()
    {
        $client = new Client();
        $request = $client->request('GET', $this->url);
        if ($request->getStatusCode() == 200) {
            return $this->parse($request->getBody()->getContents());
        }
        return false;
    }

    private function parse($source)
    {
        try {
            $parse = json_decode(json_encode(simplexml_load_string($source)), true);
            $collect = collect($parse['Currency']);

            $collect->map(function ($data) {
                $tcmb_code = $data['@attributes']['Kod'];
                $tcmb_value = $data['ForexSelling'];
                $currency = $this->currencies->where('code', $tcmb_code)->first();
                if ($currency) {
                    Currency::where('currency_id', $currency->id())->update([
                        'value' => $tcmb_value
                    ]);

                    CurrencyHistory::create([
                        'currency_id' => $currency->id(),
                        'code' => $currency->code,
                        'value' => $tcmb_value,
                        'old_value' => $currency->value,
                        'key' => 'tcmb',
                        'description' => 'TCMB Auto Update'
                    ]);
                }
            });
        } catch (\Exception $e) {
        }
        return [];
    }

    public function run()
    {
        return $this->getSource();
    }
}
