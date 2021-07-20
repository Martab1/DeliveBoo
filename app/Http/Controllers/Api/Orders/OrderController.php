<?php

namespace App\Http\Controllers\Api\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\OrderRequest;
use App\Order;
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

        // POPULATE ORDER TABLE
        $new_order = new Order();
    
        $new_order->restaurant_id = $request->restaurantId;
        $new_order->payer_name = $request->payer_name;
        $new_order->payer_email = $request->payer_email;
        $new_order->payer_address = $request->payer_address;
        $new_order->total = $amount;
        $new_order->save();

        // GENERATE SECOND KEY
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
