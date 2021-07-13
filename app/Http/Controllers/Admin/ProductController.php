<?php

namespace App\Http\Controllers\Admin;

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
    public function index()
    {
        $user_auth = Auth::user();
        $restaurants_db = Restaurant::all()->pluck("user_id");

        foreach ($restaurants_db as $user_restaurant) {
            if ($user_auth->id === $user_restaurant) {
                $my_restaurant = Restaurant::where("user_id", $user_auth->id)->get()->first();
            }
        }

        $my_products = Product::all()->where("restaurant_id", $my_restaurant->id);
        return view('admin.product.index', compact('my_products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { {
            $request->validate([
                [
                    'name' => 'required|string|min:3|max:50',
                    'description' => 'nullable|min:10|max:255',
                    'price' => 'required|numeric',
                    'visibility' => 'required|boolean',
                    'image' => 'nullable|mimes:jpg,png,jpeg,bmp,svg|size:5000',
                ],
                [
                    'required' => 'Campo obbligatorio',
                    'name.min' => 'Il nome deve essere di almeno 3 caratteri',
                    'name.max' => 'Il nome deve avere massimo 50 caratteri',
                    'description.min' => 'La descrizione deve essere di almeno 10 caratteri',
                    'description.max' => 'La descrizione deve essere massimo 255 caratteri',
                    'price.numeric' => 'Sono ammessi esclusivamente caratteri numerici',
                    'image.mimes' => 'I formati supportati sono: jpg, png, jpeg, bmp, svg',
                ],
            ]);

            $data = $request->all();

            //Add image
            if (array_key_exists('image', $data)) {
                $image = Storage::put('product-image', $data['image']);

                // override image file with path
                $data['image'] = $image;
            }

            $user_auth = Auth::user();
            $restaurants_db = Restaurant::all()->pluck("user_id");

            foreach ($restaurants_db as $user_restaurant) {
                if ($user_auth->id === $user_restaurant) {
                    $my_restaurant = Restaurant::where("user_id", $user_auth->id)->get()->first();
                }
            }

            $data["restaurant_id"] = $my_restaurant->id;

            // create and save record on db
            $new_product = new Product();
            $new_product->fill($data);
            $new_product->save();
        }
        return redirect()->route('admin.product.index');
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
    public function edit($id)
    {
        $user_auth = Auth::user();
        $restaurants_db = Restaurant::all()->pluck("user_id");

        foreach ($restaurants_db as $user_restaurant) {
            if ($user_auth->id === $user_restaurant) {
                $my_restaurant = Restaurant::where("user_id", $user_auth->id)->get()->first();
            }
        }
        $products = Product::find($id);

        if ($products) {
            return view('admin.product.edit');
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
    public function update(Request $request, $id)
    {
        // Validation
        $request->validate([
            [
                'name' => 'required|string|min:3|max:50',
                'description' => 'nullable|min:10|max:255',
                'price' => 'required|numeric',
                'visibility' => 'required|boolean',
                'image' => 'nullable|mimes:jpg,png,jpeg,bmp',
            ],
            [
                'required' => 'Campo obbligatorio',
                'name.min' => 'Il nome deve essere di almeno 3 caratteri',
                'name.max' => 'Il nome deve avere massimo 50 caratteri',
                'description.min' => 'La descrizione deve essere di almeno 10 caratteri',
                'description.max' => 'La descrizione deve essere massimo 255 caratteri',
                'price.numeric' => 'Sono ammessi esclusivamente caratteri numerici',
                'image.mimes' => 'I formati supportati sono: jpg, png, jpeg, bmp, svg',
            ],
        ]);


        $data = $request->all();

        $product = Product::find($id);

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

        return redirect()->route('admin.product.index', $product->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        // remove images
        if ($product->image) {
            Storage::delete($product->image);
        }

        // remove
        $product->delete();
        return redirect()->route('admin.product.index')->with('deleted', $product->name);
    }
}
