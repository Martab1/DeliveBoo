<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        "name", "slug", "address", "phone_number", "image"
    ];

    public function user(){
        return $this->belongsTo("App\User");
    }

        public function products(){
        return $this->hasMany("App\Product");
    }
}
