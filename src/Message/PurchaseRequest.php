<?php

namespace Omnipay\Redsys\Message;

use Descom\Redsys\Redsys;
use Omnipay\Common\Message\AbstractRequest;

/**
 * PayFast Purchase Request
 */
class PurchaseRequest extends AbstractRequest
{
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
        $this->validate(
            'transactionId',
            'amount',
            'url_notify',
            'description',
        );

        return [
            'transaction_id' => $this->getTransactionId(),
            'amount' => $this->getAmount(),
            'url_notify' => $this->getUrlNotify(),
            'url_return_successful' => $this->getUrlReturnSuccessful(),
            'url_return_denied' => $this->getUrlReturnDenied(),
            'description' => $this->getDescription(),
        ];
    }

    public function sendData($data)
    {
        $redsysRequest = $this->redsys()->generateRedirectPayment(
            $this->getTransactionId(),
            (float)$this->getAmount(),
            $this->getUrlNotify()
        )
            ->urlSuccessful($this->getUrlReturnSuccessful())
            ->urlDenied($this->getUrlReturnDenied());

        return $this->response = new PurchaseResponse($this, $data, $redsysRequest);
    }

    private function redsys(): Redsys
    {
        if ($this->getTestMode()) {
            return Redsys::sandbox($this->getMerchantParams());
        }

        return Redsys::production($this->getMerchantParams());
    }

    private function getMerchantParams(): array
    {
        return [
            'merchantCode' => $this->getMerchantCode(),
            'merchantTerminal' => $this->getMerchantTerminal(),
            'merchantSignatureKey' => $this->getMerchantSignatureKey(),
        ];
    }
}
