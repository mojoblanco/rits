<?php

namespace Mojoblanco\RITS\Helpers;

use GuzzleHttp\Client;

class ApiHelper {
    
    public static function getHeader($credentials, $requestId)
    {
        $hashString = $credentials->apiKey . $requestId . $credentials->apiToken;
        $apiHash = hash('sha512', $hashString);
//        $headers = array(
//            'Content-Type: application/json',
//            'API_KEY:' . $credentials->apiKey,
//            'REQUEST_ID:' . $requestId,
//            'REQUEST_TS:' . self::getTimeStamp(), 
//            'API_DETAILS_HASH:' . $apiHash,
//            'MERCHANT_ID:' . $credentials->merchantId
//        );
        
        $headers = [
            'Content-Type' => 'application/json',
            'API_KEY' => $credentials->apiKey,
            'REQUEST_ID' => $requestId,
            'REQUEST_TS' => self::getTimeStamp(), 
            'API_DETAILS_HASH' => $apiHash,
            'MERCHANT_ID' => $credentials->merchantId
        ];
        
        return $headers;
    }
    
    public static function getTimeStamp()
    {
        $dateTime = new \DateTime();
        $date = $dateTime->format('Y-m-d');
        $time = $dateTime->format('H:i:s');
        return $date . "T" . $time .'+000000';
    }
    
    public static function makeRequest($type, $url, $headers = null, $body = null)
    {
        $client = new Client();
        $options = ['verify' => false, 'headers' => $headers, 'json' => $body];      
        $response = $client->request($type, $url, $options);
        
        $data = (string) $response->getBody();
        
        return json_decode($data);
    }
}
