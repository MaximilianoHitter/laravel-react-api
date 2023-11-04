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
            // Process the response as needed
            // For example, you can access the country name using $response->FullCountryInfoResult->sName

            return response()->json($response);
        } catch (\SoapFault $e) {
            // Handle any SOAP errors
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
