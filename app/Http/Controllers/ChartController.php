<?php

namespace App\Http\Controllers;

use App\Chart;
use App\Order;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function index($id)
    {

        $months = Order::where("restaurant_id", $id)->select(
            DB::raw('sum(total) as `sums`'),
            DB::raw("DATE_FORMAT(created_at,'%M %Y') as months"),
            DB::raw('max(created_at) as createdAt')
            )
           ->where("created_at", ">", \Carbon\Carbon::now()->subMonths(12))
           ->orderBy('createdAt', 'asc')
           ->groupBy('months')->get();

        $array_months= [];
        $array_totals= [];
        foreach ($months as $month){
            array_push($array_months, $month['months']);
            array_push($array_totals, $month['sums']);
        }

        $array_months=str_replace("January","Gennaio",$array_months);
        $array_months=str_replace("February","Febbraio",$array_months);
        $array_months=str_replace("March","Marzo",$array_months);
        $array_months=str_replace("April","Aprile",$array_months);
        $array_months=str_replace("May","Maggio",$array_months);
        $array_months=str_replace("June","Giugno",$array_months);
        $array_months=str_replace("July","Luglio",$array_months);
        $array_months=str_replace("August","Agosto",$array_months);
        $array_months=str_replace("September","Settembre",$array_months);
        $array_months=str_replace("October","Ottobre",$array_months);
        $array_months=str_replace("November","Novembre",$array_months);
        $array_months=str_replace("December","Dicembre",$array_months);
        
        // Generate random colours for the groups
        for ($i=0; $i<=count($array_months); $i++) {
            $colours[] = "#ff8e3c";
        }

        // Prepare the data for returning with the view
        $chart = new Chart();
                $chart->labels = ($array_months);
                $chart->dataset = ($array_totals);
                $chart->colours = $colours;
        return view('admin.restaurant.chart', compact('chart', 'id'));
            }
}
