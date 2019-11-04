<?php

namespace Mojoblanco\RITS\Models;

use Mojoblanco\RITS\Helpers\Encryptor;

class PaymentStatus {
    public $reference;
    
    protected $iv;
    protected $key;

    public function __construct($iv, $key){

        $this->iv = $iv;
        $this->key = $key;
    }
    
    public function encryptedReference() {
        return Encryptor::encrypt($this->reference, $this->iv, $this->key);
    }
}
