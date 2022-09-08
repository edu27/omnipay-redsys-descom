<?php

namespace Omnipay\Redsys\Tests;

use Omnipay\Redsys\RedirectGateway;
use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->gateway = new RedirectGateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->initialize();
    }
}
