<?php

namespace Omnipay\Redsys\Tests;

use Descom\Redsys\Exceptions\SignatureInvalid;
use Omnipay\Common\GatewayInterface;
use Omnipay\Omnipay;
use Omnipay\Redsys\Message\CompletedPurchaseResponse;
use PHPUnit\Framework\TestCase;

class CompletedPurchaseTest extends TestCase
{
    private GatewayInterface $gateway;

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

    public function testCompletedPurchaseResponseInvalidSignature()
    {
        $request = $this->gateway->completePurchase();

        $this->expectException(SignatureInvalid::class);

        $request->sendData([
            'Ds_SignatureVersion' => 'HMAC_SHA256_V1',
            'Ds_MerchantParameters' => 'eyJEc19EYXRlIjoiMDUlMkYwOSUyRjIwMjIiLCJEc19Ib3VyIjoiMTUlM0ExMSIsIkRzX1NlY3VyZVBheW1lbnQiOiIxIiwiRHNfQ2FyZF9OdW1iZXIiOiI0NTQ4ODEqKioqKiowMDAzIiwiRHNfQ2FyZF9Db3VudHJ5IjoiNzI0IiwiRHNfQW1vdW50IjoiMTQ1IiwiRHNfQ3VycmVuY3kiOiI5NzgiLCJEc19PcmRlciI6IjEyMzQ2IiwiRHNfTWVyY2hhbnRDb2RlIjoiOTk5MDA4ODgxIiwiRHNfVGVybWluYWwiOiIwMDEiLCJEc19SZXNwb25zZSI6IjAwMDAiLCJEc19NZXJjaGFudERhdGEiOiIiLCJEc19UcmFuc2FjdGlvblR5cGUiOiIwIiwiRHNfQ29uc3VtZXJMYW5ndWFnZSI6IjEiLCJEc19BdXRob3Jpc2F0aW9uQ29kZSI6IjAxMzU0OCIsIkRzX0NhcmRfQnJhbmQiOiIxIiwiRHNfUHJvY2Vzc2VkUGF5TWV0aG9kIjoiMSIsIkRzX0NvbnRyb2xfMTY2MjM4MzQ2Nzc4MyI6IjE2NjIzODM0Njc3ODMifQ==',
            'Ds_Signature' => 'DtTMmr_rkXYGRvQiv3cQI2cYKoi-eLmwEsIQtPGGbad=',
        ]);
    }

    public function testCompletedPurchaseResponseSuccessful()
    {
        $request = $this->gateway->completePurchase();

        $response = $request->sendData([
            'Ds_SignatureVersion' => 'HMAC_SHA256_V1',
            'Ds_MerchantParameters' => 'eyJEc19EYXRlIjoiMDUlMkYwOSUyRjIwMjIiLCJEc19Ib3VyIjoiMTUlM0ExMSIsIkRzX1NlY3VyZVBheW1lbnQiOiIxIiwiRHNfQ2FyZF9OdW1iZXIiOiI0NTQ4ODEqKioqKiowMDAzIiwiRHNfQ2FyZF9Db3VudHJ5IjoiNzI0IiwiRHNfQW1vdW50IjoiMTQ1IiwiRHNfQ3VycmVuY3kiOiI5NzgiLCJEc19PcmRlciI6IjEyMzQ2IiwiRHNfTWVyY2hhbnRDb2RlIjoiOTk5MDA4ODgxIiwiRHNfVGVybWluYWwiOiIwMDEiLCJEc19SZXNwb25zZSI6IjAwMDAiLCJEc19NZXJjaGFudERhdGEiOiIiLCJEc19UcmFuc2FjdGlvblR5cGUiOiIwIiwiRHNfQ29uc3VtZXJMYW5ndWFnZSI6IjEiLCJEc19BdXRob3Jpc2F0aW9uQ29kZSI6IjAxMzU0OCIsIkRzX0NhcmRfQnJhbmQiOiIxIiwiRHNfUHJvY2Vzc2VkUGF5TWV0aG9kIjoiMSIsIkRzX0NvbnRyb2xfMTY2MjM4MzQ2Nzc4MyI6IjE2NjIzODM0Njc3ODMifQ==',
            'Ds_Signature' => 'DtTMmr_rkXYGRvQiv3cQI2cYKoi-eLmwEsIQtPGGogg=',
        ]);

        $this->assertInstanceOf(CompletedPurchaseResponse::class, $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('0000', $response->getCode());
        $this->assertEquals('12346', $response->getTransactionId());
        $this->assertEquals('013548', $response->getTransactionReference());
    }

    public function testCompletedPurchaseResponseDenied()
    {
        $request = $this->gateway->completePurchase();

        $response = $request->sendData([
            'Ds_SignatureVersion' => 'HMAC_SHA256_V1',
            'Ds_MerchantParameters' => 'eyJEc19EYXRlIjoiMDYlMkYwOSUyRjIwMjIiLCJEc19Ib3VyIjoiMTElM0EwOSIsIkRzX1NlY3VyZVBheW1lbnQiOiIwIiwiRHNfQW1vdW50IjoiMTU1IiwiRHNfQ3VycmVuY3kiOiI5NzgiLCJEc19PcmRlciI6IjEyMzQ3IiwiRHNfTWVyY2hhbnRDb2RlIjoiOTk5MDA4ODgxIiwiRHNfVGVybWluYWwiOiIwMDEiLCJEc19SZXNwb25zZSI6Ijk5MTUiLCJEc19NZXJjaGFudERhdGEiOiIiLCJEc19UcmFuc2FjdGlvblR5cGUiOiIwIiwiRHNfQ29uc3VtZXJMYW5ndWFnZSI6IjEiLCJEc19FcnJvckNvZGUiOiJTSVM5OTE1IiwiRHNfQXV0aG9yaXNhdGlvbkNvZGUiOiIrKysrKysiLCJEc19Db250cm9sXzE2NjI0NTUzNTIyMzEiOiIxNjYyNDU1MzUyMjMxIn0=',
            'Ds_Signature' => 'SnscKzno53LbKYg1x91TRRMDn77u3P7WUrd2WJeSYMY=',
        ]);

        $this->assertFalse($response->isSuccessful());
        $this->assertEquals('12347', $response->getTransactionId());
        $this->assertEquals('9915', $response->getCode());
    }
}
