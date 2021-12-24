<?php

namespace App\Services\Payment\Providers;

use App\Services\Payment\Contracts\AbstractProvicerInterface;
use App\Services\Payment\Contracts\PayableInterface;
use App\Services\Payment\Contracts\VerifiableInterface;

class IDPayProvider extends AbstractProvicerInterface implements PayableInterface,VerifiableInterface
{
    public function pay()
    {
        $params = array(
            'order_id' => $this->request->getOrderId(),
            'amount' => $this->request->getAmount(),
            'name' => $this->request->getUserName(),
            'phone' => $this->request->getUserMobile(),
            'mail' => $this->request->getUserEmail(),
            'callback' => route('payment.callback'),
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.idpay.ir/v1.1/payment');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'X-API-KEY: '.$this->request->getAPIKey().'',
            'X-SANDBOX: 1'
        ));
    }

    public function verify()
    {

    }
}

