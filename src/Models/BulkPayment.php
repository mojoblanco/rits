<?php

namespace Mojoblanco\RITS\Models;

use Mojoblanco\RITS\Helpers\Encryptor;

class BulkPayment {
    
    public $bankCode; 
    
    public $batchRef; 
    
    public $debitAccount; 
    
    public $narration; 
    
    public $beneficiaries;
    
    protected $iv;
    protected $key;
    
    public function __construct($iv, $key) {
        $this->iv = $iv;
        $this->key = $key;
    }

    public function encryptedBankCode() {
        return Encryptor::encrypt($this->bankCode, $this->iv, $this->key);
    }
    
    public function encryptedBatchRef() {
        return Encryptor::encrypt($this->batchRef, $this->iv, $this->key);
    }
    
    public function encryptedDebitAccount() {
        return Encryptor::encrypt($this->debitAccount, $this->iv, $this->key);
    }
    
    public function encryptedNarration() {
        return Encryptor::encrypt($this->narration, $this->iv, $this->key);
    }
    
    public function encryptedTotal() {
        $total = array_reduce($this->beneficiaries, function($carry, $item) 
                {
                    return $carry + $item->amount;
                });
        
        return Encryptor::encrypt($total, $this->iv, $this->key);
    }
    
    public function getEncryptedData() 
    {
        $data = [
            'bankCode'      => $this->encryptedBankCode(),
            'batchRef'      => $this->encryptedBatchRef(),
            'debitAccount'  => $this->encryptedDebitAccount(),
            'narration'     => $this->encryptedNarration(),
            'totalAmount'   => $this->encryptedTotal(),
        ];
        
        return (object) $data;
    }
    
    public function getEncryptedBeneficiaries() {
        return array_map(function($x) {
            return $x->getEncryptedData();
        }, $this->beneficiaries);
    }
 
}
