<?php

namespace Mojoblanco\RITS;

use Mojoblanco\RITS\Constants\Urls;
use Mojoblanco\RITS\Helpers\ApiHelper;

class RITSService
{
    private $baseUrl;
    private $credentials;

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
        
        $this->baseUrl = Urls::getBaseUrl($credentials->env);
    }
    
    public function getActiveBanks()
    {
        $headers = ApiHelper::getHeaders($this->credentials);
        $url = $this->baseUrl . Urls::$activeBanks;
        
        $result = ApiHelper::makeRequest('POST', $url, $headers);
        
        return $result;
    }
    
    public function accountEnquiry($payload)
    {
        $headers = ApiHelper::getHeaders($this->credentials);
        $url = $this->baseUrl . Urls::$accountInquiry;
        
        $data = [
            'accountNo' => $payload->getAccountNo(),
            'bankCode' => $payload->encryptedBankCode()
        ];
        
        $result = ApiHelper::makeRequest('POST', $url, $headers, $data);
        
        return $result;
    }
    
    function getSinglePaymentStatus($payload)
    {
        $headers = ApiHelper::getHeaders($this->credentials);
        $url = $this->baseUrl . Urls::$singlePaymentStatus;
        
        $data = [
            'transRef' => $payload->encryptedTransRef()
        ];
        
        $result = ApiHelper::makeRequest('POST', $url, $headers, $data);
        
        return $result;
    }
    
    public function makeSinglePayment($payload)
    {
        $headers = ApiHelper::getHeaders($this->credentials);
        $url = $this->baseUrl . Urls::$singlePayment;
        
        $data = [
            'amount' => $payload->encryptedAmount(),
            'beneficiaryEmail' => $payload->getBeneficiaryEmail(),
            'creditAccount' => $payload->getCreditAccount(),
            'debitAccount' => $payload->encryptedDebitAccount(),
            'fromBank' => $payload->getFromBank(),
            'narration' => $payload->encryptedNarration(),
            'toBank' => $payload->getToBank(),
            'transRef' => $payload->getTransRef()
        ];
        
        $result = ApiHelper::makeRequest('POST', $url, $headers, $data);
        
        return $result;
    }
    
    public function makeBulkPayment($payload)
    {
        $headers = ApiHelper::getHeaders($this->credentials);
        $url = $this->baseUrl . Urls::$bulkPayment;
        
        $data = [
            'bulkPaymentInfo' => $payload->getEncryptedData(),
            'paymentDetails' => $payload->getEncryptedBeneficiaries(),

        ];
        
        $result = ApiHelper::makeRequest('POST', $url, $headers, $data);
        
        return $result;
    }
}