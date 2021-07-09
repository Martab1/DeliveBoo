<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        "name", "image", "description", "price", "visibility",
    ];

    public function restaurant(){
        return $this->belongsTo("App\Restaurant");
    }

        public function orders(){
        return $this->belongsToMany("App\Order");
    }

}

