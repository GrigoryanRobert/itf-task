<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;

class ApiGuzzelRequests
{
    /**
     * @param string $url
     * @return \Illuminate\Http\Client\Response
     */
    public static function guzzel_get_requests(string $url)
    {
        $response = Http::get($url);
        if($response->getStatusCode() == 200){
            return $response->json();
        }
    }

}
