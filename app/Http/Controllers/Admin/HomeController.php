<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $user_auth = Auth::user();
        $restaurants_db = Restaurant::all()->pluck("user_id"); 
        $my_restaurant = null;
        $my_tipologies = []; 

        foreach ($restaurants_db as $user_restaurant){
            if($user_auth->id === $user_restaurant){
                $logged = true;
                $my_restaurant = Restaurant::where("user_id",$user_auth->id)->get()->first();
                $my_tipologies = $my_restaurant->tipologies;
            }
        }

        // POPOLAZIONE TABELLA PIVOT 
        // $array1 = [1,5,2,4,8];
        // $array2 = [2,4,2,5,8];

        // $restaurant_2 = Restaurant::find(2);
        // $restaurant_3 = Restaurant::find(3);
        // $restaurant_2->tipologies()->attach($array1);
        // $restaurant_3->tipologies()->attach($array2);
        return view('admin.home', compact('my_restaurant', 'user_auth', 'my_tipologies'));
    }
}


// CANCELLARE SEEDER FITTIZIO RESTAURANT
// CANCELLARE POPOLAZIONE TABELLA PIVOT 