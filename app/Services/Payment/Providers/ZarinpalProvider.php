<?php

namespace App\Services\Payment\Providers;

use App\Services\Payment\Contracts\AbstractProvicerInterface;
use App\Services\Payment\Contracts\PayableInterface;
use App\Services\Payment\Contracts\VerifiableInterface;

class ZarinpalProvider extends AbstractProvicerInterface implements PayableInterface,VerifiableInterface
{

    public function pay()
    {

    }

    public function verify()
    {

    }

}
