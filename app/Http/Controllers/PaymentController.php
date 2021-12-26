<?php

namespace App\Http\Controllers;

use App\Http\Requests\Payment\PayRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Services\Payment\PaymentService;
use App\Services\Payment\Requests\IDPayRequest;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function pay(PayRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::firstOrCreate([
            'email' =>$validatedData['email'],
        ],[
            'name' =>$validatedData['name'],
            'email' =>$validatedData['email'],
            'mobile' => $validatedData['mobile'],
        ]);


        try {
            $orderItems = json_decode(Cookie::get('basket'),true);
            $products = Product::findMany(array_keys($orderItems));
            $productsPrice = array_sum(array_column($orderItems,'price'));
            $ref_code = Str::random(30);
            $createdOrder = Order::create([
                'amount'=>$productsPrice,
                'ref_code'=>$ref_code,
                'status' =>'unpaid',
                'user_id'=>$user->id,
            ]);

            $createdOrder->orderItems->createMany();

        }catch (\Exception $e) {
            return back()->with('failed',$e->getMessage());
        }

//        $idpayRequest = new IDPayRequest([
//            'amount' => 1000,
//            'user' => $user
//        ]);
//        $paymentService = new PaymentService(PaymentService::IDPAY, $idpayRequest);
    }

    public function callback()
    {

    }
}
