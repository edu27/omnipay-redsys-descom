<?php

namespace Omnipay\Redsys\Tests;

use Descom\Redsys\Merchants\MerchantBuilder;
use Descom\Redsys\Parameters;
use Descom\Redsys\Response;
use Omnipay\Redsys\Message\Rest\BuildFromRedsysResponse;
use PHPUnit\Framework\TestCase;

class BuildFromRedsysResponseTest extends TestCase
{
    public function testGenerateOmnipayResponseFromRedsysResponse()
    {
        $redsysData = [
            'Ds_MerchantCode' => '999008881',
            'Ds_Terminal' => '1',
            'Ds_Response' => '0000',
            'Ds_Amount' => '145',
            'Ds_Order' => '12346',
            'Ds_AuthorisationCode' => '145',
        ];

        $redsysResponse = new Response(MerchantBuilder::testing(), new Parameters($redsysData));

        $omnipayResponse = new BuildFromRedsysResponse($redsysResponse);

        $this->assertTrue($omnipayResponse->isSuccessful());
        $this->assertEquals('0000', $omnipayResponse->getCode());
        $this->assertEquals('12346', $omnipayResponse->getTransactionId());
        $this->assertEquals('145', $omnipayResponse->getTransactionReference());
    }

    public function testGenerateOmnipayResponseFromRedsysResponseFailed()
    {
        $redsysData = [
            'Ds_MerchantCode' => '999008881',
            'Ds_Terminal' => '1',
            'Ds_Response' => '1000',
            'Ds_Amount' => '145',
            'Ds_Order' => '12346',
        ];

        $redsysResponse = new Response(MerchantBuilder::testing(), new Parameters($redsysData));

        $omnipayResponse = new BuildFromRedsysResponse($redsysResponse);

        $this->assertFalse($omnipayResponse->isSuccessful());
    }
}
