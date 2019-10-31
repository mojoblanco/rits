<?php


namespace Mojoblanco\RITS\Helpers;

class Encryptor {
    public static function encrypt($data, $iv, $key)
    {
        $cipherText = trim(base64_encode(openssl_encrypt($data, 'AES-128-CBC', $key, true, $iv)));
        unset($data, $iv, $key);
        return $cipherText;
    }
}
