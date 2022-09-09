# Omnipay:: Offline dummy

Omnipay Offline Dummy Gateway for testing

[![tests](https://github.com/descom-es/omnipay-offline-dummy/actions/workflows/tests.yml/badge.svg)](https://github.com/descom-es/omnipay-offline-dummy/actions/workflows/tests.yml)
[![analyse](https://github.com/descom-es/omnipay-offline-dummy/actions/workflows/analyse.yml/badge.svg)](https://github.com/descom-es/omnipay-offline-dummy/actions/workflows/analyse.yml)
[![style-fix](https://github.com/descom-es/omnipay-offline-dummy/actions/workflows/style-fix.yml/badge.svg)](https://github.com/descom-es/omnipay-offline-dummy/actions/workflows/style-fix.yml)

## Instalation

```sh
composer require descom/omnipay-offline-dummy
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

$response = $request->sendData([
    'Ds_SignatureVersion' => 'HMAC_SHA256_V1',
    'Ds_MerchantParameters' => 'eyJEc19EYXRlIjoiMDUlMkYwOSUyRjIwMjIiLCJEc19Ib3VyIjoiMTUlM0ExMSIsIkRzX1NlY3VyZVBheW1lbnQiOiIxIiwiRHNfQ2FyZF9OdW1iZXIiOiI0NTQ4ODEqKioqKiowMDAzIiwiRHNfQ2FyZF9Db3VudHJ5IjoiNzI0IiwiRHNfQW1vdW50IjoiMTQ1IiwiRHNfQ3VycmVuY3kiOiI5NzgiLCJEc19PcmRlciI6IjEyMzQ2IiwiRHNfTWVyY2hhbnRDb2RlIjoiOTk5MDA4ODgxIiwiRHNfVGVybWluYWwiOiIwMDEiLCJEc19SZXNwb25zZSI6IjAwMDAiLCJEc19NZXJjaGFudERhdGEiOiIiLCJEc19UcmFuc2FjdGlvblR5cGUiOiIwIiwiRHNfQ29uc3VtZXJMYW5ndWFnZSI6IjEiLCJEc19BdXRob3Jpc2F0aW9uQ29kZSI6IjAxMzU0OCIsIkRzX0NhcmRfQnJhbmQiOiIxIiwiRHNfUHJvY2Vzc2VkUGF5TWV0aG9kIjoiMSIsIkRzX0NvbnRyb2xfMTY2MjM4MzQ2Nzc4MyI6IjE2NjIzODM0Njc3ODMifQ==',
    'Ds_Signature' => 'DtTMmr_rkXYGRvQiv3cQI2cYKoi-eLmwEsIQtPGGogg=',
]);


if ($response->isSuccessful()) {
    // $response->TransactionId();
    // $response->TransactionReference();
}
```
