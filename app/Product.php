<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        "name", "image", "description", "price", "visibility", "restaurant_id", "category_id"
    ];

    public function restaurant(){
        return $this->belongsTo("App\Restaurant");
    }

        public function orders(){
        return $this->belongsToMany("App\Order");
    }

    public function category(){
        return $this->belongsTo("App\Category");
    }

}


