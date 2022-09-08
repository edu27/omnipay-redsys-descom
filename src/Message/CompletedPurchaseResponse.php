<?php

namespace Omnipay\Redsys\Message;

use Descom\Redsys\Redsys;
use Descom\Redsys\Response;
use Omnipay\Common\Message\AbstractResponse;

class CompletedPurchaseResponse extends AbstractResponse
{
    private Response $redsysResponse;

    public function __construct(CompletedPurchaseRequest $request, $data)
    {
        parent::__construct($request, $data);

        $this->redsysResponse = $this->redsys($request)->capturePaymentNotification($data);
    }

    public function isSuccessful()
    {
        return $this->redsysResponse->successful();
    }

    public function getTransactionId()
    {
        return $this->redsysResponse->order;
    }

    public function getTransactionReference()
    {
        return $this->redsysResponse->authorizationCode;
    }

    public function getMessage()
    {
        return $this->redsysResponse->errorCode;
    }

    public function getCode()
    {
        return $this->redsysResponse->errorCode;
    }

    private function redsys(CompletedPurchaseRequest $request): Redsys
    {
        if ($request->getTestMode()) {
            return Redsys::sandbox($this->getMerchantParams($request));
        }

        return Redsys::production($this->getMerchantParams($request));
    }

    private function getMerchantParams(CompletedPurchaseRequest $request): array
    {
        return [
            'code' => $request->getMerchantCode(),
            'terminal' => $request->getMerchantTerminal(),
            'signatureKey' => $request->getMerchantSignatureKey(),
        ];
    }
}
