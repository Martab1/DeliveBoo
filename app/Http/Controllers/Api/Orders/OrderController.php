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

        $product = Product::find($request->product);

        $result = $gateway->transaction()->sale([
            "amount" => $product->price,
            "paymentMethodNonce" => $request->token,
            "option" => [
                "submitForSettlement" => true,
            ]
        ]);

        if($request->success){
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
