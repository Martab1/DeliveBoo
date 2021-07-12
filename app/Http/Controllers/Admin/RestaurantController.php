<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Restaurant;
use App\Tipology;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipologies = Tipology::all();

        return view('admin.restaurant.create', compact('tipologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        $tipologies = Tipology::all();

        return view('admin.restaurant.edit', compact('restaurant', 'tipologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        /* 
            VALIDATION
        */
        $request->validate([
            'name' => 'required',
            'address' =>'required',
            'phone_number' => 'required',
            'tipologies' => 'nullable|exists:tipologies,id',
        ]);// customizzare gli errori

        $data = $request->all();
        $data['slug'] = Str::slug($data['name'], '-');
        $restaurant->update( $data );

        /* 
            UPDATING TIPOLOGIES TABLE TOO
        */
        if( array_key_exists( 'tipologies', $data ) ){
            $restaurant->tipologies()->sync($data['tipologies']);
        }else{
            $restaurant->tipologies()->detach();
        }
        
        return view('admin.home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
