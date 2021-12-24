<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Payment\PaymentService;
use App\Services\Payment\Requests\IDPayRequest;

class PaymentController extends Controller
{
    public function pay()
    {
        $user = User::first();
        $idpayRequest = new IDPayRequest([
            'amount' => 1000,
            'user' => $user
        ]);
        $paymentService = new PaymentService(PaymentService::IDPAY, $idpayRequest);
        dd($paymentService->pay());
    }

    public function callback()
    {

    }
}
