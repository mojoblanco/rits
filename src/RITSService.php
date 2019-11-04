<?php

namespace Mojoblanco\RITS;

use Mojoblanco\RITS\Constants\Urls;
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
        $url = $this->credentials->baseUrl . Urls::$activeBanks;
        
        $result = ApiHelper::makeRequest('POST', $url, $headers);
        
        return $result;
    }
    
    public function accountEnquiry($payload)
    {
        $headers = ApiHelper::getHeaders($this->credentials);
        $url = $this->credentials->baseUrl . Urls::$accountInquiry;
        
        $data = [
            'accountNo' => $payload->getAccountNo(),
            'bankCode' => $payload->encryptedBankCode()
        ];
        
        $result = ApiHelper::makeRequest('POST', $url, $headers, $data);
        
        return $result;
    }

    public function makeSinglePayment($payload)
    {
        $headers = ApiHelper::getHeaders($this->credentials);
        $url = $this->credentials->baseUrl . Urls::$singlePayment;
        
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
        $url = $this->credentials->baseUrl . Urls::$bulkPayment;
        
        $data = [
            'bulkPaymentInfo' => $payload->getEncryptedData(),
            'paymentDetails' => $payload->getEncryptedBeneficiaries(),

        ];
        
        $result = ApiHelper::makeRequest('POST', $url, $headers, $data);
        
        return $result;
    }
}