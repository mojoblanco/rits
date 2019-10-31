<?php

namespace Mojoblanco\RITS\Constants;

class Urls {
    
    public static $accountInquiry = "merc/fi/account/lookup";
    
    public static $activeBanks = "fi/banks";
    
    public static $addAccount = "merc/account/token/init";
    
    public static $validateAccountOTP = "merc/account/token/validate";
    
    public static $singlePaymentStatus = "merc/payment/status";
    
    public static $bulkPaymentStatus = "merc/bulk/payment/status";
    
    public static $singlePayment = "merc/payment/singlePayment.json";
    
    public static $bulkPayment = "merc/bulk/payment/send";
}
