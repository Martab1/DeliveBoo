<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        "payer_name", "payer_email", "payer_address", "total"
    ];

    public function restaurant(){
        return $this->belongsTo("App\Restaurant");
    }

    public function products(){
        return $this->belongsToMany("App\Product");
    }

}
