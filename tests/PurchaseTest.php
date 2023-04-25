<?php

namespace Omnipay\Redsys\Tests;

use Descom\Redsys\Environments\Sandbox;
use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Omnipay;
use Omnipay\Redsys\Gateway;
use Omnipay\Redsys\Message\PurchaseRequest;
use Omnipay\Redsys\Message\PurchaseResponse;
use PHPUnit\Framework\TestCase;

class PurchaseTest extends TestCase
{
    private Gateway $gateway;
    private Gateway $gatewayBizum;

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

        $this->gatewayBizum = Omnipay::create('Redsys');

        $this->gatewayBizum->initialize([
            'merchantCode' => '999008881',
            'merchantTerminal' => '1',
            'merchantSignatureKey' => 'sq7HjrUOBfKmC576ILgskD5srU870gJ7',
            'testMode' => true,
            'merchantPaymethods' => 'z',
        ]);
    }

    public function testPurchaseRequest()
    {
        $request = $this->gateway->purchase([
            'amount' => '12.00',
            'description' => 'Test purchase',
            'transactionId' => 1,
            'notifyUrl' => 'http://localhost:8080/gateway/notify',
        ]);

        $this->assertInstanceOf(PurchaseRequest::class, $request);
        $this->assertSame('12.00', $request->getAmount());
    }

    public function testPurchaseSend()
    {
        $response = $this->gateway->purchase([
            'amount' => '12.00',
            'description' => 'Test purchase',
            'transactionId' => 1,
        ])->send();

        $this->assertInstanceOf(PurchaseResponse::class, $response);
        $this->assertTrue($response->isRedirect());
        $this->assertEquals((new Sandbox())->getUrlRedirect(), $response->getRedirectUrl());

        $responseParameters = $this->gerParameters($response);

        $this->assertEquals('C', $responseParameters['DS_MERCHANT_PAYMETHODS'] ?? 'C');
    }

    public function testPurchaseSendBizum()
    {
        $response = $this->gatewayBizum->purchase([
            'amount' => '12.00',
            'description' => 'Test purchase',
            'transactionId' => 1,
        ])->send();

        $responseParameters = $this->gerParameters($response);

        $this->assertEquals('z', $responseParameters['DS_MERCHANT_PAYMETHODS']);
    }

    public function testPurchaseRedirect()
    {
        $responseHtml = $this->gateway
            ->purchase([
                'amount' => '12.00',
                'description' => 'Test purchase',
                'transactionId' => 1,
            ])
            ->send()
            ->getRedirectResponse()
            ->getContent();


        $this->assertStringContainsString(
            '<input type="hidden" name="Ds_Signature" value="mseyOIMoLEjI3bcQukNeZmoPhLhQDYKt3+A8PsjGVDg=" />',
            $responseHtml
        );

        $this->assertStringContainsString(
            '<input type="hidden" name="Ds_MerchantParameters" value="eyJEU19NRVJDSEFOVF9NRVJDSEFOVENPREUiOiI5OTkwMDg4ODEiLCJEU19NRVJDSEFOVF9URVJNSU5BTCI6IjEiLCJEU19NRVJDSEFOVF9UUkFOU0FDVElPTlRZUEUiOiIwIiwiRFNfTUVSQ0hBTlRfQU1PVU5UIjoiMTIwMCIsIkRTX01FUkNIQU5UX0NVUlJFTkNZIjoiOTc4IiwiRFNfTUVSQ0hBTlRfT1JERVIiOiIxIiwiRFNfTUVSQ0hBTlRfTUVSQ0hBTlRVUkwiOiIiLCJEU19NRVJDSEFOVF9VUkxPSyI6IiIsIkRTX01FUkNIQU5UX1VSTEtPIjoiIn0=" />',
            $responseHtml
        );
    }

    private function gerParameters(AbstractResponse $redirectData): array
    {
        return json_decode(base64_decode($redirectData->getRedirectData()['Ds_MerchantParameters']), true);
    }
}
