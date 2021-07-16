<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use App\Restaurant;
use App\Tipology;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index(Request $request){
        $search = $request->query('tipology');
        
        $tipology = Tipology::where("name", "like" , "%".$search."%")->with(["restaurants"])->get()->first();
        
        return response()->json($tipology);
    }

    public function show($slug){
        $restaurant = Restaurant::where("slug", $slug)->with(["tipologies"])->get()->first();
       
        // dd($restaurant->id);
        $products = Product::where("restaurant_id", $restaurant->id)->with(["category"])->get();
        
        $data = [
            "restaurant" => $restaurant,
            "products" => $products,
        ];

        return response()->json($data);
    }
}
