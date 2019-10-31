<?php

namespace Mojoblanco\RITS;

use Mojoblanco\RITS\Helpers\ApiHelper;

class RITSService
{
    private $credentials;

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }
    
    public function getActiveBanks($requestId)
    {
        $headers = ApiHelper::getHeaders($this->credentials, $requestId);
        $url = $this->credentials->baseUrl . 'fi/banks';
        
        $result = ApiHelper::makeRequest('POST', $url, $headers);
        
        return $result;
    }

    public function makeSinglePayment($requestId, $payload)
    {
        $headers = ApiHelper::getHeaders($this->credentials, $requestId);
        $url = $this->credentials->baseUrl . 'merc/payment/singlePayment.json';
        
        $data = [
            'amount' => $payload->getAmount(),
            'beneficiaryEmail' => $payload->getBeneficiaryEmail(),
            'creditAccount' => $payload->getCreditAccount(),
            'debitAccount' => $payload->getDebitAccount(),
            'fromBank' => $payload->getFromBank(),
            'narration' => $payload->getNarration(),
            'toBank' => $payload->getToBank(),
            'transRef' => $payload->getTransRef()
        ];
        
        $result = ApiHelper::makeRequest('POST', $url, $headers, $data);
        
        return $result;
    }

}