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
        $my_restaurants = null;


        foreach ($restaurants_db as $user_restaurant){
            if($user_auth->id === $user_restaurant){
                $my_restaurants = Restaurant::where("user_id",$user_auth->id)->get();
            }
        }

        return view('admin.home',  compact('my_restaurants', 'user_auth'));
    }
}
