<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Restaurant;
use App\Http\Controllers\Admin\DB;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {   
        if(!Restaurant::find($id)){
        abort(404);
        }
        elseif(Auth::user()->id == Restaurant::find($id)->user->id){
            $restaurant_id = $id;
            $my_products= Product::where("restaurant_id", $id)->paginate(12);
            return view('admin.product.index', compact('my_products', 'restaurant_id'));
        }else{
            abort(404);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if(!Restaurant::find($id)){
            abort(404);
        }elseif(Auth::user()->id == Restaurant::find($id)->user_id){
            $categories = Category::all();
            $restaurant_id = $id;
            return view('admin.product.create', compact('restaurant_id', 'categories'));
        }else{
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { {

            $request->validate(
                [
                    'name' => 'required|string|min:3|max:50',
                    'description' => 'nullable|max:255',
                    'price' => 'required|numeric|max:999.99',
                    'visibility' => 'required|boolean',
                    'image' => 'nullable|mimes:jpg,png,jpeg,bmp,svg|max:5000',
                    'category_id' => 'exists:categories,id|required',

                ],
                [
                    'required' => 'Campo obbligatorio',
                    'name.min' => 'Il nome deve essere di almeno :min caratteri',
                    'name.max' => 'Il nome deve avere massimo :max caratteri',
                    'description.max' => 'La descrizione deve essere massimo :max caratteri',
                    'price.numeric' => 'Sono ammessi esclusivamente caratteri numerici',
                    'price.max' => 'Il valore massimo consentito è :max',
                    'image.mimes' => 'I formati supportati sono: jpg, png, jpeg, bmp, svg',
                    'image.max' => 'Il file inserito eccede le misure massime consentite(5000kb )',
                    'visibility.boolean' => 'Il valore inserito non è corretto',
                ]
            );

            $data = $request->all();
            //Add image
            if (array_key_exists('image', $data)) {
                $image = Storage::put('product-image', $data['image']);

                // override image file with path
                $data['image'] = $image;
            }

            // create and save record on db
            $new_product = new Product();
            $new_product->fill($data); 
            $new_product->save();
        }
        return redirect()->route('admin.product.index', $new_product->restaurant->id);
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
    public function edit(Product $product)
    {
        foreach(Auth::user()->restaurants as $restaurant){
            if($product->restaurant_id == $restaurant->id) {
                $categories = Category::all();
                return view('admin.product.edit', compact('product', 'categories'));  
            }
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        foreach(Auth::user()->restaurants as $restaurant){
            if($product->restaurant_id == $restaurant->id) {
                // Validation
                $request->validate(
                    [
                        'name' => 'required|string|min:3|max:50',
                        'description' => 'nullable|max:255',
                        'price' => 'required|numeric',
                        'visibility' => 'required|boolean',
                        'image' => 'nullable|mimes:jpg,png,jpeg,bmp,svg|max:5000',
                    ],
                    [
                        'required' => 'Campo obbligatorio',
                        'name.min' => 'Il nome deve essere di almeno 3 caratteri',
                        'name.max' => 'Il nome deve avere massimo 50 caratteri',
                        'description.max' => 'La descrizione deve essere massimo 255 caratteri',
                        'price.numeric' => 'Sono ammessi esclusivamente caratteri numerici',
                        'image.mimes' => 'I formati supportati sono: jpg, png, jpeg, bmp, svg',
                        'image.max' => 'Il file inserito eccede le misure massime consentite(5000kb )',
                        'visibility.boolean' => 'Il valore inserito non è corretto',
                ]);


                $data = $request->all();

                // Image update
                if (array_key_exists('image', $data)) {
                    // delete previous one
                    if ($product->image) {
                        Storage::delete($product->image);
                    }

                    // set new one
                    $data['image'] = Storage::put('product-image', $data['image']);
                }

                $product->update($data);

                return redirect()->route('admin.product.index', $product['restaurant_id']);
            }
        }
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        foreach(Auth::user()->restaurants as $restaurant){
            if($product->restaurant_id == $restaurant->id) {
                // remove images
                if ($product->image) {
                Storage::delete($product->image);
                }
                // remove
                $product->delete();
                return redirect()->route('admin.product.index', $product->restaurant->id)->with('deleted', $product->name);
            }
        }
        abort(404);
    }

}
