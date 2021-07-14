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
        $my_restaurants = $user_auth->restaurants;

        return view('admin.home',  compact('my_restaurants', 'user_auth'));
    }
}

