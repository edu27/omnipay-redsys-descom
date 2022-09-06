<?php

namespace Omnipay\Redsys\Message;

use Descom\Redsys\Payments\RedirectRequest;
use Descom\Redsys\Response;
use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Message\RequestInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    private RedirectRequest $redsysRequest;

    public function __construct(RequestInterface $request, array $data, RedirectRequest $redsysRequest)
    {
        parent::__construct($request, $data);

        $this->redsysRequest = $redsysRequest;
    }

    public function isSuccessful()
    {
        return false;
    }

    public function isRedirect()
    {
        return true;
    }

    public function getRedirectUrl()
    {
        return $this->redsysRequest->getUrlRedirect();
    }

    public function getRedirectMethod()
    {
        return 'POST';
    }

    public function getRedirectData()
    {
        return $this->redsysRequest->getFormData();
    }

    public function redirect()
    {
        return $this->redsysRequest->redirect();
    }
}
