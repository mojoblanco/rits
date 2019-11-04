<?php

namespace Mojoblanco\RITS\Constants;

class Urls {
    private static $liveUrl = "https://login.remita.net/remita/exapp/api/v1/send/api/rpgsvc/rpg/api/v2/";
    
    private static $demoUrl = "https://remitademo.net/remita/exapp/api/v1/send/api/rpgsvc/rpg/api/v2/";

    public static $accountInquiry = "merc/fi/account/lookup";
    
    public static $activeBanks = "fi/banks";
    
    public static $addAccount = "merc/account/token/init";
    
    public static $validateAccountOTP = "merc/account/token/validate";
    
    public static $singlePaymentStatus = "merc/payment/status";
    
    public static $bulkPaymentStatus = "merc/bulk/payment/status";
    
    public static $singlePayment = "merc/payment/singlePayment.json";
    
    public static $bulkPayment = "merc/bulk/payment/send";
    
    
    
    public static function getBaseUrl($env) 
    {
        if ($env == 'LIVE') {
            return self::$liveUrl;
        }
        
        return self::$demoUrl;
    }
}
