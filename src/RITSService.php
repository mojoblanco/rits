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
    
    public function getActiveBanks()
    {
        $headers = ApiHelper::getHeaders($this->credentials);
        $url = $this->credentials->baseUrl . 'fi/banks';
        
        $result = ApiHelper::makeRequest('POST', $url, $headers);
        
        return $result;
    }
    
    public function accountEnquiry($payload)
    {
        $headers = ApiHelper::getHeaders($this->credentials);
        $url = $this->credentials->baseUrl . 'merc/fi/account/lookup';
        
        $data = [
            'accountNo' => $payload->getAccountNo(),
            'bankCode' => $payload->getBankCode()
        ];
        
        $result = ApiHelper::makeRequest('POST', $url, $headers, $data);
        
        return $result;
    }

    public function makeSinglePayment($requestId, $payload)
    {
        $headers = ApiHelper::getHeaders($this->credentials);
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