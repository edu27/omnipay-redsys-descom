<?php

namespace Omnipay\Redsys\Message;

use Descom\Redsys\Redsys;
use Descom\Redsys\Response;
use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

class CompletedPurchaseResponse extends AbstractResponse
{
    private Response $redsysResponse;

    public function __construct(RequestInterface $request, $data)
    {
        parent::__construct($request, $data);

        $this->redsysResponse = $this->redsys($request)->capturePaymentNotification($data);
    }


    public function isSuccessful()
    {
        return $this->redsysResponse->successful();
    }

    private function redsys(RequestInterface $request): Redsys
    {
        if ($request->getTestMode()) {
            return Redsys::sandbox($this->getMerchantParams($request));
        }

        return Redsys::production($this->getMerchantParams($request));
    }

    private function getMerchantParams(RequestInterface $request): array
    {
        return [
            'code' => $request->getMerchantCode(),
            'terminal' => $request->getMerchantTerminal(),
            'signatureKey' => $request->getMerchantSignatureKey(),
        ];
    }
}
