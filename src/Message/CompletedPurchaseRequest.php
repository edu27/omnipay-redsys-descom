<?php

namespace Omnipay\Redsys\Message;

use Omnipay\Common\Message\AbstractRequest;

/**
 * PayFast Purchase Request
 */
class CompletedPurchaseRequest extends AbstractRequest
{
    public function getDsSignature()
    {
        return $this->getParameter('Ds_Signature');
    }

    public function setDsSignature($value): self
    {
        return $this->setParameter('Ds_Signature', $value);
    }

    public function getDsMerchantParameters()
    {
        return $this->getParameter('Ds_MerchantParameters');
    }

    public function setDsMerchantParameters($value): self
    {
        return $this->setParameter('Ds_MerchantParameters', $value);
    }

    public function getDsSignatureVersion()
    {
        return $this->getParameter('Ds_SignatureVersion');
    }

    public function setDsSignatureVersion($value): self
    {
        return $this->setParameter('Ds_SignatureVersion', $value);
    }

    public function getMerchantCode()
    {
        return $this->getParameter('merchantCode');
    }

    public function setMerchantCode($value): self
    {
        return $this->setParameter('merchantCode', $value);
    }

    public function getMerchantTerminal()
    {
        return $this->getParameter('merchantTerminal');
    }

    public function setMerchantTerminal($value): self
    {
        return $this->setParameter('merchantTerminal', $value);
    }

    public function getMerchantSignatureKey()
    {
        return $this->getParameter('merchantSignatureKey');
    }

    public function setMerchantSignatureKey($value): self
    {
        return $this->setParameter('merchantSignatureKey', $value);
    }

    public function getTestMode()
    {
        return $this->getParameter('testMode');
    }

    public function setTestMode($value): self
    {
        return $this->setParameter('testMode', $value);
    }

    public function getUrlNotify()
    {
        return $this->getParameter('url_notify');
    }

    public function setUrlNotify($value): self
    {
        return $this->setParameter('url_notify', $value);
    }

    public function getUrlReturnSuccessful()
    {
        return $this->getParameter('url_return_successful');
    }

    public function setUrlReturnSuccessful($value): self
    {
        return $this->setParameter('url_return_successful', $value);
    }

    public function getUrlReturnDenied()
    {
        return $this->getParameter('url_return_denied');
    }

    public function setUrlReturnDenied($value): self
    {
        return $this->setParameter('url_return_denied', $value);
    }

    public function getData()
    {
        return [
            'Ds_SignatureVersion' => $this->getDsSignatureVersion(),
            'Ds_MerchantParameters' => $this->getDsMerchantParameters(),
            'Ds_Signature' => $this->getDsSignature(),
        ];
    }

    public function sendData($data)
    {
        return $this->response = new CompletedPurchaseResponse($this, $data);
    }
}
