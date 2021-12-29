<?php

namespace App\Services\Payment\Requests;

use App\Services\Payment\Contracts\RequestInterface;

class IDPayVerifyRequest implements RequestInterface
{
    private $orderId;
    private $APIKey;
    private $id;

    public function __construct(array $data)
    {
        $this->orderId = $data['orderId'];
        $this->APIKey = $data['apiKey'];
        $this->id = $data['id'];
    }

    public function getId()
    {
        return $this->id;
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

