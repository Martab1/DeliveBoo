<?php

namespace App\Http\Controllers\Api\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\OrderRequest;
use App\Mail\SendAdminMail;
use App\Mail\SendMail;
use App\Order;
use App\Product;
use App\Restaurant;
use App\User;
use Braintree\Gateway;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function generate(Request $request, Gateway $gateway){

        $data = [
            "success" => true,
            "token" => $gateway->clientToken()->generate(),
        ];

        return response()->json($data,200);
    }

    public function makePayment(Request $request, Gateway $gateway){

        $validator = Validator::make($request->all(),[
            "token" => "required",
            "products" => "required",
            "restaurantId" => "required",
            'payer_name' => "required|string|min:3|max:50",
            'payer_email' => "required",
            'payer_address' => "required|min:3|max:50",
            'payer_city' => "required|min:3|max:50",
            'payer_cap' => "required|digits:5",
        ],[
            'required'=> 'Questo campo è obbligatorio',
            'name.max'=> 'Massimo :max caratteri concessi',
            'min'=> 'Minimo :min caratteri richiesti',
        ]);
        if($validator->fails()){
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }
        
        $this_restaurant = Restaurant::find($request->restaurantId);
        $amount = 0;
        $all_products = [];
        foreach($request->products as $product){
            $this_product = Product::where("id", $product['productId'])->where("restaurant_id", $this_restaurant->id)->get()->first();
            $amount +=  $this_product->price * $product['qty'];
            // PUSH IN ARRAY FOR DATA EMAIL
            $this_product["qty"] = $product['qty'];
            array_push($all_products, $this_product);
        }

        // POPULATE ORDER TABLE
        $new_order = new Order();
    
        $new_order->restaurant_id = $request->restaurantId;
        $new_order->payer_name = $request->payer_name;
        $new_order->payer_email = $request->payer_email;
        $new_order->payer_address = "$request->payer_city ($request->payer_cap) $request->payer_address";
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
            // $verification = $result->paymentMethod->verification;
            $data = [
                "success" => true,
                "message" => "Transazione avvenuta con successo",
            ];

            $user= User::where("id", $this_restaurant["user_id"])->get()->first();

            $this_order =  [
                "total" => $amount,
                "restaurant_name" => $this_restaurant->name,
                "payer_name" => $request->payer_name,
                "restaurant_id" => $this_restaurant->id,
                "payer_address" => $request->payer_address,
                "all_products" => $all_products,
                "deliveboo_client" => $user['name'],
            ];

            Mail::to($request->payer_email)->send(new SendMail($this_order));

            Mail::to($user['email'])->send(new SendAdminMail($this_order));

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
