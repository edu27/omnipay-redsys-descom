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
    'url_notify' => 'http://example.com/payment/notify',
    'url_return' => 'http://example.com/payment/return',
]);

$request = $gateway->purchase([
                'amount' => '12.00',
                'description' => 'Test purchase',
                'transactionId' => 1,
            ])->send();

$response->redirect();
```
