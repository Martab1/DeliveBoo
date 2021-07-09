<?php

use App\Restaurant;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurants = [
            [   
                "user_id" => 1,
                "name" => "kebab keboh",
                "slug" => "kebab_keboh",
                "address" => "via dove si mangia il kebab buono",
                "phone_number" => "3458884512",
                "image" => "https://cdn.pixabay.com/photo/2017/02/09/14/09/kebab-2052498_960_720.jpg",
            ],
            [
                "user_id" => 3,
                "name" => "pizzeria Pesto Genovese",
                "slug" => "pizzeria_Pesto_Genovese",
                "address" => "via dove si mangia una pizza da favola",
                "phone_number" => "34585446252",
                "image" => "https://cdn.pixabay.com/photo/2020/06/08/16/49/pizza-5275191_960_720.jpg",
            ],
        ];

        
        foreach ($restaurants as $restaurant){
            $new_restaurant = new Restaurant();
            
            $new_restaurant->user_id = $restaurant['user_id'];
            $new_restaurant->name = $restaurant['name'];
            $new_restaurant->slug = $restaurant['slug'];
            $new_restaurant->address = $restaurant['address'];
            $new_restaurant->phone_number = $restaurant['phone_number'];
            $new_restaurant->image = $restaurant['image'];
        
        $new_restaurant->save();
        }
    }
}
