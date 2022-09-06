<?php

namespace Omnipay\Redsys;

use Omnipay\Common\AbstractGateway;
use Omnipay\Redsys\Message\CompletedPurchaseRequest;
use Omnipay\Redsys\Message\PurchaseRequest;

class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Redsys';
    }

    public function getDefaultParameters()
    {
        return array(
            'merchantCode' => '',
            'merchantTerminal' => '',
            'merchantSignatureKey' => '',
            'testMode' => false,
            'url_notify' => '',
            'url_return_successful' => '',
            'url_return_denied' => '',
        );
    }

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

    public function getUrlNotify()
    {
        return $this->getParameter('url_notify');
    }

    public function setUrlNotify($value)
    {
        return $this->setParameter('url_notify', $value);
    }

    public function getUrlReturnSuccessful()
    {
        return $this->getParameter('url_return_successful');
    }

    public function setUrlReturnSuccessful($value)
    {
        return $this->setParameter('url_return_successful', $value);
    }

    public function getUrlReturnDenied()
    {
        return $this->getParameter('url_return_denied');
    }

    public function setUrlReturnDenied($value)
    {
        return $this->setParameter('url_return_denied', $value);
    }

    public function purchase(array $parameters = [])
    {
        return $this->createRequest(PurchaseRequest::class, $parameters);
    }

    public function completePurchase(array $parameters = [])
    {
        return $this->createRequest(CompletedPurchaseRequest::class, $parameters);
    }
}
