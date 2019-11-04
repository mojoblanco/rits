<?php

namespace Mojoblanco\RITS\Models;

use Mojoblanco\RITS\Helpers\Encryptor;

class Account {
    
    public $accountNo;
    public $bankCode; 
    
    protected $iv;
    protected $key;

    public function __construct($iv, $key) {
        $this->iv = $iv;
        $this->key = $key;
    }

    public function encryptedAccountNo() {
        return Encryptor::encrypt($this->accountNo, $this->iv, $this->key);
    }
    
    public function encryptedBankCode() {
        return Encryptor::encrypt($this->bankCode, $this->iv, $this->key);
    }
}
