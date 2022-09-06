<?php

namespace Omnipay\Redsys\Tests;

use Omnipay\Redsys\Gateway;
use Omnipay\Redsys\Message\CompletedPurchaseRequest;
use Omnipay\Redsys\Message\CompletedPurchaseResponse;
use Omnipay\Omnipay;
use PHPUnit\Framework\TestCase;

class CompletedPurchaseTest extends TestCase
{
    private Gateway $gateway;

    public function setUp(): void
    {
        parent::setUp();

        $this->gateway = Omnipay::create('Redsys');

        $this->gateway->initialize([
            'merchantCode' => '999008881',
            'merchantTerminal' => '1',
            'merchantSignatureKey' => 'sq7HjrUOBfKmC576ILgskD5srU870gJ7',
            'testMode' => true,
        ]);
    }

    // public function testCompletedPurchaseRequest()
    // {
    //     $request = $this->gateway->completePurchase([
    //         'amount' => '12.00',
    //         'description' => 'Test purchase',
    //         'transactionId' => 1,
    //     ]);

    //     $this->assertInstanceOf(CompletedPurchaseRequest::class, $request);
    //     $this->assertSame('12.00', $request->getAmount());
    // }

    public function testCompletedPurchaseResponseGetReference()
    {
        $request = $this->gateway->completePurchase([
            'amount' => '12.00',
            'description' => 'Test purchase',
            'transactionId' => 1,
        ]);

        $response = $request->sendData([
            'Ds_SignatureVersion' => 'HMAC_SHA256_V1',
            'Ds_MerchantParameters' => 'eyJEc19EYXRlIjoiMDUlMkYwOSUyRjIwMjIiLCJEc19Ib3VyIjoiMTUlM0ExMSIsIkRzX1NlY3VyZVBheW1lbnQiOiIxIiwiRHNfQ2FyZF9OdW1iZXIiOiI0NTQ4ODEqKioqKiowMDAzIiwiRHNfQ2FyZF9Db3VudHJ5IjoiNzI0IiwiRHNfQW1vdW50IjoiMTQ1IiwiRHNfQ3VycmVuY3kiOiI5NzgiLCJEc19PcmRlciI6IjEyMzQ2IiwiRHNfTWVyY2hhbnRDb2RlIjoiOTk5MDA4ODgxIiwiRHNfVGVybWluYWwiOiIwMDEiLCJEc19SZXNwb25zZSI6IjAwMDAiLCJEc19NZXJjaGFudERhdGEiOiIiLCJEc19UcmFuc2FjdGlvblR5cGUiOiIwIiwiRHNfQ29uc3VtZXJMYW5ndWFnZSI6IjEiLCJEc19BdXRob3Jpc2F0aW9uQ29kZSI6IjAxMzU0OCIsIkRzX0NhcmRfQnJhbmQiOiIxIiwiRHNfUHJvY2Vzc2VkUGF5TWV0aG9kIjoiMSIsIkRzX0NvbnRyb2xfMTY2MjM4MzQ2Nzc4MyI6IjE2NjIzODM0Njc3ODMifQ==',
            'Ds_Signature' => 'DtTMmr_rkXYGRvQiv3cQI2cYKoi-eLmwEsIQtPGGogg=',
        ]);

        $this->assertInstanceOf(CompletedPurchaseResponse::class, $response);

        // $response = new CompletedPurchaseResponse(
        //     $request,
        //     [
        //         'Ds_SignatureVersion' => 'HMAC_SHA256_V1',
        //         'Ds_MerchantParameters' => 'eyJEc19EYXRlIjoiMDUlMkYwOSUyRjIwMjIiLCJEc19Ib3VyIjoiMTUlM0ExMSIsIkRzX1NlY3VyZVBheW1lbnQiOiIxIiwiRHNfQ2FyZF9OdW1iZXIiOiI0NTQ4ODEqKioqKiowMDAzIiwiRHNfQ2FyZF9Db3VudHJ5IjoiNzI0IiwiRHNfQW1vdW50IjoiMTQ1IiwiRHNfQ3VycmVuY3kiOiI5NzgiLCJEc19PcmRlciI6IjEyMzQ2IiwiRHNfTWVyY2hhbnRDb2RlIjoiOTk5MDA4ODgxIiwiRHNfVGVybWluYWwiOiIwMDEiLCJEc19SZXNwb25zZSI6IjAwMDAiLCJEc19NZXJjaGFudERhdGEiOiIiLCJEc19UcmFuc2FjdGlvblR5cGUiOiIwIiwiRHNfQ29uc3VtZXJMYW5ndWFnZSI6IjEiLCJEc19BdXRob3Jpc2F0aW9uQ29kZSI6IjAxMzU0OCIsIkRzX0NhcmRfQnJhbmQiOiIxIiwiRHNfUHJvY2Vzc2VkUGF5TWV0aG9kIjoiMSIsIkRzX0NvbnRyb2xfMTY2MjM4MzQ2Nzc4MyI6IjE2NjIzODM0Njc3ODMifQ==',
        //         'Ds_Signature' => 'DtTMmr_rkXYGRvQiv3cQI2cYKoi-eLmwEsIQtPGGogg=',
        //     ]
        // );

        $this->assertTrue($response->isSuccessful());
    }

    // public function testCompletedPurchaseResponseSuccess()
    // {
    //     $response = $this->gateway->completePurchase([
    //         'amount' => '12.00',
    //         'description' => 'Test purchase',
    //         'transactionId' => 1,
    //         'status' => App::STATUS_SUCCESS,
    //     ])->send();

    //     $this->assertTrue($response->isSuccessful());
    // }

    // public function testCompletedPurchaseResponseDenied()
    // {
    //     $response = $this->gateway->completePurchase([
    //         'amount' => '12.00',
    //         'description' => 'Test purchase',
    //         'transactionId' => 1,
    //         'status' => App::STATUS_DENIED,
    //     ])->send();

    //     $this->assertFalse($response->isSuccessful());
    // }
}
