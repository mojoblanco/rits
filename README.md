# RITS

A Laravel Package for Remita Interbank Transfer Service

## Prerequisites
- Register as a merchant/biller on the [Remita]('https://www.remita.net/') platform.
- Get your credentials from Remita such as Merchant ID, API Key etc.

## Installation
Open your terminal or command prompt, go to the root directory of your Laravel project, then run the following command

    composer require mojoblanco/rits

## Usage

### Setup Credentials
To use any of the available you need to set up your credentials first

```php
use Mojoblanco\RITS\Models\Credential;

$credentials = Credential();
$credentials->merchantId = $merchantId;
$credentials->apiKey = $apiKey;
$credentials->apiToken = $apiToken;
$credentials->key = $key;
$credentials->iv = $iv;
$credentials->environment = 'DEMO'; //Can either be LIVE or DEMO
```

### Available Services

#### Bulk Payment
1. Build the list of your beneficiaries

    ```php
    use Mojoblanco\RITS\Models\BulkBeneficiary;

    $beneficiaries = [];

    for ($i = 0; $i < 10; $i++) {
        $bb = new BulkBeneficiary($iv, $key);
        $bb->amount = 100;
        $bb->accountNumber = '0582915208015;
        $bb->bankCode = '058';
        $bb->email = 'test@mail.com';
        $bb->narration = 'Test payment';
        $bb->transRef = rand(); //Make sure it is something you can track.

        array_push($beneficiaries, $bb);
    }
    ```

2. Call the bulk payment service

    ```php
    use Mojoblanco\RITS\RITSService;

    $bp = new BulkPayment($iv, $key);
    $bp->batchRef = '12345678987654321;
    $bp->debitAccount = '1234565678'
    $bp->bankCode = '044'
    $bp->narration = 'Test bulk payment'
    $bp->beneficiaries = $beneficiaries;

    $service = new RITSService($credentials);
    $response = $service->makeBulkPayment($bp);
    ```


### How can you thank me?
You can like this repo, follow me on [github](https://github.com/mojoblanco) and [twitter](https://twitter.com/themojoblanco)

Thanks. 🙂
