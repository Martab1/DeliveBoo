<?php

namespace App\Http\Controllers\Api\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\OrderRequest;
use App\Product;
use App\Restaurant;
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
        
        $this_restaurant = Restaurant::find($request->restaurantId);
        $amount = 0;
        foreach($request->products as $product){
            $this_product = Product::where("id", $product['productId'])->where("restaurant_id", $this_restaurant->id)->get()->first();
            $amount +=  $this_product->price * $product['qty'];
        }

        $result = $gateway->transaction()->sale([
            "amount" => $amount,
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
