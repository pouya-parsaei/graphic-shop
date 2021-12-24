<?php

namespace App\Services\Payment\Contracts;

abstract class AbstractProvicerInterface
{
    public function __construct(protected RequestInterface $request)
    {

    }

}
