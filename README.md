# Omnipay:: Redsys

Redsys driver for Omnipay

## Instalation

```sh
composer require descom/omnipay-redsys
```

## Basic Usage

### Create purchase request

```php
use Omnipay\Omnipay;

$gateway = Omnipay::create('Redsys');

$gateway->initialize([
    'merchantCode' => '999008881',
    'merchantTerminal' => '1',
    'merchantSignatureKey' => 'sq7HjrUOBfKmC576ILgskD5srU870gJ7',
    'testMode' => true,
]);

$request = $gateway->purchase([
                'amount' => 12.50,
                'description' => 'Test purchase',
                'transactionId' => 1,
                'notifyUrl' => 'http://localhost:8080/gateway/notify',
            ])->send();

$response->redirect();
```

### Complete purchase request

```php
use Omnipay\Omnipay;

$gateway = Omnipay::create('Redsys');

$gateway->initialize([
    'merchantCode' => '999008881',
    'merchantTerminal' => '1',
    'merchantSignatureKey' => 'sq7HjrUOBfKmC576ILgskD5srU870gJ7',
    'testMode' => true,
]);

$request = $this->gateway->completePurchase();

/*
Redsys notification payment
$_POST = [
    'Ds_SignatureVersion' => 'HMAC_SHA256_V1',
    'Ds_MerchantParameters' => '...',
    'Ds_Signature' => '...',
];
*/
$redsysNotificationData = $_POST;

$response = $request->sendData($redsysNotificationData);


if ($response->isSuccessful()) {
    // $dsOrder = $response->transactionId();
    // $dsAuthorizationCode = $response->transactionReference();
}  else {
    // $dsResponse = $response->getCode();
}
```
