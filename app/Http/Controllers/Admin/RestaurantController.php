<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tipology;
use App\Restaurant;
use Illuminate\Validation\Rule;
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
            'name'=> 'required|string|min:2|max:50',
            'address' => "required|min:2|max:255",
            'phone_number' => 'required|digits_between:7,15|numeric|unique:restaurants',
            'tipologies' => 'exists:tipologies,id|required_without_all',
            'image' => 'nullable|mimes:jpg,jpeg,png,bmp,svg|max:5000',
        ],[
            'required'=> 'Questo campo è obbligatorio',
            'name.max'=> 'Massimo :max caratteri concessi',
            'min'=> 'Minimo :min caratteri richiesti',
            'digits_between' => 'Inserisci un numero di telefono valido',
            'numeric' => 'Inserisci solo numeri',
            'exists' => 'valore non valido',
            'required_without_all' => 'Seleziona almeno una casella',
            'mimes' => 'I formati supportati sono: jpg,jpeg,png,bmp,svg',
            'image.max' => 'Il file inserito eccede le misure massime consentite(5000kb )',
            'phone_number.unique'=> 'il numero inserito è già esistente'
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
        $my_restaurant = $restaurant;
        $user_auth = Auth::user();
        return view('admin.restaurant.show', compact('my_restaurant', 'user_auth'));
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
            'name'=> 'required|min:2|max:50',
            'address' => "required|min:2|max:255",
            'phone_number' => [
                'required',
                'digits_between:7,15',
                'numeric',
                 Rule::unique('restaurants')->ignore($restaurant)
            ],
            'tipologies' => 'exists:tipologies,id|required_without_all',
            'image' => 'nullable|mimes:jpg,jpeg,png,bmp,svg|max:5000',
        ],[
            'required'=> 'Questo campo è obbligatorio',
            'max'=> 'Massimo :max caratteri concessi',
            'min'=> 'Minimo :min caratteri richiesti',
            'digits_between' => 'Inserisci un numero di telefono valido',
            'numeric' => 'Inserisci solo numeri',
            'exists' => 'valore non valido',
            'required_without_all' => 'Seleziona almeno una casella',
            'mimes' => 'I formati supportati sono: jpg,jpeg,png,bmp,svg',
            'image.max' => 'Il file inserito eccede le misure massime consentite(5000kb)',
            'phone_number.unique'=> 'il numero inserito è già esistente'
        ]);


        $data = $request->all();
        $data['slug'] = Str::slug($data['name'], '-');

        /* IMAGE */
        if(array_key_exists('image', $data)){
            if($restaurant->image){
                Storage::delete($restaurant->image);
            }
            $image = Storage::put('restaurant-image', $data['image']);
            $data['image'] = $image;
        }

        /*UPDATING TIPOLOGIES TABLE TOO*/
        if( array_key_exists( 'tipologies', $data ) ){
            $restaurant->tipologies()->sync($data['tipologies']);
        }else{
            $restaurant->tipologies()->detach();
        }

        $restaurant->update( $data );

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
        $restaurant = Restaurant::find($id);

        if($restaurant->image){
            Storage::delete($restaurant->image);
        }

        $restaurant->tipologies()->detach();
        $restaurant->delete();

        return redirect()->route('admin.home')->with('deleted', $restaurant->name);
    }
}
