<?php

namespace Omnipay\Redsys\Message\Rest;

use Descom\Redsys\Response;
use Omnipay\Common\Message\AbstractResponse;

class BuildFromRedsysResponse extends AbstractResponse
{
    public function __construct(private Response $redsysResponse)
    {
    }

    public function isSuccessful()
    {
        return $this->redsysResponse->successful();
    }

    public function getTransactionId()
    {
        return $this->redsysResponse->orderId;
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
        return $this->redsysResponse->responseCode;
    }

    public function getData()
    {
        return $this->redsysResponse->toArray();
    }
}
