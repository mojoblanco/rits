<?php

namespace Mojoblanco\RITS\Models;

use Mojoblanco\RITS\Helpers\Encryptor;

class BulkBeneficiary {
    
    public $amount;
    
    public $accountNumber; 
    
    public $bankCode;
    
    public $email;
    
    public $narration; 
    
    public $transRef;
    
    protected $iv;
    protected $key;
    
    public function __construct($iv, $key) {
        $this->iv = $iv;
        $this->key = $key;
    }

    public function encryptedAmount() {
        return Encryptor::encrypt($this->amount, $this->iv, $this->key);
    }
    
    public function encryptedAccountNumber() {
        return Encryptor::encrypt($this->accountNumber, $this->iv, $this->key);
    }
    
    public function encryptedBankCode() {
        return Encryptor::encrypt($this->bankCode, $this->iv, $this->key);
    }
    
    public function encryptedEmail() {
        return Encryptor::encrypt($this->email, $this->iv, $this->key);
    }
    
    public function encryptedNarration() {
        return Encryptor::encrypt($this->narration, $this->iv, $this->key);
    }
    
    public function encryptedTransRef() {
        return Encryptor::encrypt($this->transRef, $this->iv, $this->key);
    }


    public function getEncryptedData() 
    {
        $data = [
            'amount'      => $this->encryptedAmount(),
            'benficiaryAccountNumber' => $this->encryptedAccountNumber(),
            'benficiaryBankCode' => $this->encryptedBankCode(),
            'benficiaryEmail' => $this->encryptedEmail(),
            'naration' => $this->encryptedNarration(),
            'transRef' => $this->encryptedTransRef(),
        ];
        
        return (object) $data;
    }
}
