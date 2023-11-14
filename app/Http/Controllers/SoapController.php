<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SoapController extends Controller
{
    public function consume(Request $request)
    {
        $url = "http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso?WSDL";
        $client = new \SoapClient($url, [
            'trace' => 1,
            'exceptions' => true,
        ]);

        $params = [
            'sCountryISOCode' => $request->param_country,
        ];

        try {
            $response = $client->__soapCall('FullCountryInfo', [$params]);
            return response()->json($response);
        } catch (\SoapFault $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
