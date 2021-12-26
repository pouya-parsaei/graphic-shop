<?php

namespace App\Services\Payment\Requests;

use App\Services\Payment\Contracts\RequestInterface;

class IDPayRequest implements RequestInterface
{
    private $amount;
    private $user;
    private $orderId;
    private $APIKey;

    public function __construct(array $data)
    {
        $this->amount = $data['amount'];
        $this->user = $data['user'];
        $this->orderId = $data['orderId'];
        $this->APIKey = $data['apiKey'];
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getOrderId()
    {
        return $this->orderId;
    }

    public function getAPIKey()
    {
        return $this->APIKey;
    }
}

