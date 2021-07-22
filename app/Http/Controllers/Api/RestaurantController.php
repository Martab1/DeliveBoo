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
    public function index(Request $request){
        /* array con tutte le tipologie dei ristoranti */
        $tipologies = Tipology::all();

        /* dati da passare in json */
        $data = [
            'tipologies' => $tipologies
        ];
       
        return response()->json($data);
    }


    /* FILTRAGGIO RISTORANTI */
    public function filteredRestaurants(Request $request){
        /* array di tipologie ottenute dalle checkbox */
       /*  $reqTipologies = ['5', '8', '9', '12', '11', '10', '1', '2', '4', '3', '1']; */
        $reqTipologies = $request;

        /* $restaurants = Tipology::all()->whereIn('id', $reqTipologies)->with('restaurants')->get(); */

        /* $restaurants = Restaurant::join('restaurant_tipology', 'restaurant_tipology.restaurant_id', '=' , 'restaurants.id')
        ->join('tipologies', 'restaurant_tipology.tipology_id', '=', 'tipologies.id')
        ->whereIn('tipologies.id', $reqTipologies)
        ->get(); */

        /* chiamata a db con relazione */
        $restaurants = Restaurant::whereHas('tipologies', function($q) use($reqTipologies) {
            $q->whereIn('tipology_id', $reqTipologies);
        })->get();
        /* $restaurants = Tipology::whereIn('id', $reqTipologies)->with('restaurants')->get() */;

        /* dati da passare in json */
        $data = [
            'restaurants' => $restaurants,
        ];

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
