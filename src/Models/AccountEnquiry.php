<?php

namespace Mojoblanco\RITS\Models;

use Mojoblanco\RITS\Helpers\Encryptor;

class AccountEnquiry {
    
    public $accountNo;
    public $bankCode; 
    
    protected $iv;
    protected $key;

    public function __construct($iv, $key) {
        $this->iv = $iv;
        $this->key = $key;
    }

    public function getAccountNo() {
        return Encryptor::encrypt($this->accountNo, $this->iv, $this->key);
    }
    
    public function getBankCode() {
        return Encryptor::encrypt($this->bankCode, $this->iv, $this->key);
    }
}
