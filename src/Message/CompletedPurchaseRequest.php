<?php

namespace Omnipay\Redsys\Message;

use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Redsys\App\App;

/**
 * PayFast Purchase Request
 */
class CompletedPurchaseRequest extends AbstractRequest
{
    public function getMerchantCode()
    {
        return $this->getParameter('merchantCode');
    }

    public function setMerchantCode($value)
    {
        return $this->setParameter('merchantCode', $value);
    }

    public function getMerchantTerminal()
    {
        return $this->getParameter('merchantTerminal');
    }

    public function setMerchantTerminal($value)
    {
        return $this->setParameter('merchantTerminal', $value);
    }

    public function getMerchantSignatureKey()
    {
        return $this->getParameter('merchantSignatureKey');
    }

    public function setMerchantSignatureKey($value)
    {
        return $this->setParameter('merchantSignatureKey', $value);
    }

    public function getTestMode()
    {
        return $this->getParameter('testMode');
    }

    public function setTestMode($value)
    {
        return $this->setParameter('testMode', $value);
    }

    public function getData()
    {
        return $this->httpRequest->request->all();
    }

    public function sendData($data)
    {
        return $this->response = new CompletedPurchaseResponse($this, $data);
    }
}
