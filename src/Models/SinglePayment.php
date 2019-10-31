<?php


namespace Mojoblanco\RITS\Models;

use Mojoblanco\RITS\Helpers\Encryptor;

class SinglePayment {
    
    public $amount;
    public $beneficiaryEmail;
    public $creditAccount; 
    public $debitAccount; 
    public $fromBank; 
    public $narration; 
    public $requestId; 
    public $toBank;
    public $transRef; 
    
    protected $iv;
    protected $key;

    public function __construct($iv, $key){

        $this->iv = $iv;
        $this->key = $key;
    }

    public function getAmount() {
        return Encryptor::encrypt($this->amount, $this->iv, $this->key);
    }
    
    public function getBeneficiaryEmail() {
        return Encryptor::encrypt($this->beneficiaryEmail, $this->iv, $this->key);
    }
    
    public function getCreditAccount() {
        return Encryptor::encrypt($this->creditAccount, $this->iv, $this->key);
    }
    
    public function getDebitAccount() {
        return Encryptor::encrypt($this->debitAccount, $this->iv, $this->key);
    }
    
    public function getFromBank() {
        return Encryptor::encrypt($this->fromBank, $this->iv, $this->key);
    }
    
    public function getNarration() {
        return Encryptor::encrypt($this->narration, $this->iv, $this->key);
    }
    
    public function getRequestId() {
        return Encryptor::encrypt($this->requestId, $this->iv, $this->key);
    }
    
    public function getToBank() {
        return Encryptor::encrypt($this->toBank, $this->iv, $this->key);
    }
    
    public function getTransRef() {
        return Encryptor::encrypt($this->transferRef, $this->iv, $this->key);
    }
}
