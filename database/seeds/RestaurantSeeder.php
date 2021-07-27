<?php

use App\Restaurant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pizzerie = [
            [
                'name' => 'Shardana',
                'address' => 'Catania',
            ],
            [
                'name' => "Kiki",
                'address' => 'Domodossola',
            ],
            [
                'name' => "Great Heart",
                'address' => 'Trento',
            ],
            [
                'name' => 'Clorofilla',
                'address' => 'Trieste',
            ],
        ];


        foreach($pizzerie as $restaurant){
            $new_record = new Restaurant();

            $new_record->name = $restaurant['name'];
            $new_record->slug = Str::slug( $new_record->name, '-' );
            $new_record->address = $restaurant['address'];
            $new_record->user_id = 4;
            $new_record->phone_number = '0210010' + rand(0, 9999);
            
            $new_record->save();
            $new_record->tipologies()->sync([17]);
        }
    }
}
