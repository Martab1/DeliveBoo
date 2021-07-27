<?php

namespace App\Http\Controllers;

use App\Charts\PulseChart;
use App\Restaurant;
use Chartisan\PHP\Chartisan;
use Illuminate\Http\Request;

class PulseController extends Controller
{
    public function index(){

        $chart = new PulseChart("ciao");

        return view('admin.restaurant.chart', compact('chart'));
    }
}
