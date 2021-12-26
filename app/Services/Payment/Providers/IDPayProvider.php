<?php

namespace App\Services\Payment\Providers;

use App\Services\Payment\Contracts\AbstractProvicerInterface;
use App\Services\Payment\Contracts\PayableInterface;
use App\Services\Payment\Contracts\VerifiableInterface;

class IDPayProvider extends AbstractProvicerInterface implements PayableInterface,VerifiableInterface
{
    public function pay()
    {
        dd($this->request);
        $params = array(
            'order_id' => $this->request->getOrderId(),
            'amount' => $this->request->getAmount(),
            'name' => $this->request->getUser()->name,
            'phone' => $this->request->getUser()->mobile,
            'mail' => $this->request->getUser()->email,
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
        $result = curl_exec($ch);
        curl_close($ch);
        dd($result);
    }

    public function verify()
    {

    }
}

