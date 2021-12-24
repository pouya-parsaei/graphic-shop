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
    }

    public function verify()
    {

    }
}

