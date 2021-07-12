<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Restaurant extends Model
{
    protected $fillable = [
        "name", "slug", "address", "phone_number", "image", "user_id",
    ];

    public function user(){
        return $this->belongsTo("App\User");
    }

        public function products(){
        return $this->hasMany("App\Product");
    }

    public function tipologies(){
        return $this->belongsToMany("App\Tipology");
    }

    public function orders(){
        return $this->hasMany("App\Order");
    }
}
