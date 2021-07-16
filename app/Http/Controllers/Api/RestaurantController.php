<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Restaurant;
use App\Tipology;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index(Request $request){
        $search = $request->query('tipology');
        
        $tipology = Tipology::where("name", $search)->with(["restaurants"])->get()->first();
        
        return response()->json($tipology);
    }
}
