<?php

namespace App\Http\Controllers\Api\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\OrderRequest;
use App\Product;
use Braintree\Gateway;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function generate(Request $request, Gateway $gateway){

        $data = [
            "success" => true,
            "token" => $gateway->clientToken()->generate(),
        ];

        return response()->json($data,200);
    }

    public function makePayment(OrderRequest $request, Gateway $gateway){

        // dd($request);
        $result = $gateway->transaction()->sale([
            "amount" => $request->amount,
            "paymentMethodNonce" => $request->token,
            "options" => [
                "submitForSettlement" => true,
            ]
        ]);

        if($result->success){
            $data = [
                "success" => true,
                "message" => "Transazione avvenuta con successo",
            ];
            return response()->json($data,200);
        }else{
            $data = [
                "success" => false,
                "message" => "Transazione negata"
            ];
            return response()->json($data,401);
        };
    }
}
