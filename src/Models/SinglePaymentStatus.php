<?php

namespace Mojoblanco\RITS\Models;

use Mojoblanco\RITS\Helpers\Encryptor;

class SinglePaymentStatus {
    public $transRef;
    
    protected $iv;
    protected $key;

    public function __construct($iv, $key){

        $this->iv = $iv;
        $this->key = $key;
    }
    
    public function encryptedTransRef() {
        return Encryptor::encrypt($this->transRef, $this->iv, $this->key);
    }
}
