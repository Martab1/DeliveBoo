<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $auth_id = Auth::id();
        $restaurants_db = Restaurant::all()->pluck("user_id");
        $logged = false;

        foreach ($restaurants_db as $user_restaurant){
            if($auth_id === $user_restaurant)
            $logged = true;
        }

        return view('admin.home', compact('auth_id', 'restaurants_db', 'logged'));
    }
}
