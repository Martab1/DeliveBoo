<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use App\Restaurant;
use App\Tipology;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /* TIPOLOGIE RISTORANTI */
    public function index(){
        /* array con tutte le tipologie dei ristoranti */
        $tipologies = Tipology::all();
        $restaurants = Restaurant::inRandomOrder()->paginate(12);

        /* dati da passare in json */
        $data = [
            'tipologies' => $tipologies,
            'restaurants' => $restaurants
        ];
       
        return response()->json($data);
    }

    /* FILTRAGGIO RISTORANTI */
    public function filteredRestaurants(Request $request){
        /* array di tipologie ottenute dalle checkbox */
       $req = $request['tipology'];

        /* chiamata a db con relazione */
        $restaurants = Restaurant::whereHas('tipologies', function($q) use($req) {
            $q->whereIn('tipology_id', $req);
        })->paginate(12);

        return response()->json($restaurants);
    }

    /* SHOW PER IL MENU RISTORANTE */
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
