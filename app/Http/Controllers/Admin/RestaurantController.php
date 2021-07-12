<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tipology;
use App\Restaurant;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\support\Str;

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
         $request->validate([
            'name'=> 'required|min:2|max:50', 
            'address' => "required|min:8|max:255|regex:/[a-zA-Z']/",
            'phone_number' => 'required|digits_between:7,15|numeric',
            'tipologies' => 'exists:tipologies,id|required_without_all',
            'image' => 'nullable|mimes:jpg,jpeg,png,bmp|size:10|',   
        ], [
            'required'=> 'Questo campo è obbligatorio',
            'max'=> 'Massimo :max caratteri concessi',
            'min'=> 'Minimo :min caratteri richiesti',
        ]);


         $data = $request->all();

        //  image
        if(array_key_exists('image', $data)){
            $image = Storage::put('restaurant-image', $data['image']);
            $data['image'] = $image;
        }
        
         //generate slug
         $data['slug'] = Str::slug($data['name'], '-');

         // user
         $data['user_id'] = Auth::user()->id;
        
        $new_restaurant = new Restaurant();
        $new_restaurant->fill($data);
        $new_restaurant->save();

        // Save relation with tipologies (pivot)
        if(array_key_exists('tipologies', $data)){
            $new_restaurant->tipologies()->attach($data['tipologies']); // aggiunge i nuovi records in table pivot
        }

        return redirect()->route('admin.home');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)

    {
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
            'image' => 'nullable|mimes:jpg,jpeg,png,bmp|max:10240|'
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
        

        return redirect()->route('admin.home');
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
