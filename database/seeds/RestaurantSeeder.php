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

            // Pizzerie
            [
                'name' => 'Al Vialetto',
                'address' => 'Roma',
            ],
            [
                'name' => 'Pizza Sprint',
                'address' => 'Palermo',
            ],
            [
                'name' => 'Verace',
                'address' => 'Milano',
            ],
            [
                'name' => 'Pino Pizza',
                'address' => 'Torino',
            ],
            [
                'name' => 'Pizza da Gino',
                'address' => 'Genova',
            ],
            [
                'name' => 'Vesuvio',
                'address' => 'Napoli',
            ],
            [
                'name' => 'Vesuvio',
                'address' => 'Napoli',
            ],
            [
                'name' => 'Vesuvio',
                'address' => 'Napoli',
            ],
            [
                'name' => 'Vesuvio',
                'address' => 'Napoli',
            ],
            [
                'name' => 'De Santis',
                'address' => 'Foggia',
            ],

            // Giapponese
        ];

        foreach($pizzerie as $restaurant){
            $new_record = new Restaurant();

            $new_record->name = $restaurant['name'];
            $new_record->slug = Str::slug( $new_record->name, '-' );
            $new_record->address = $restaurant['address'];
            $new_record->user_id = 1;
            $new_record->phone_number = '0210010' + rand(0, 999);
            
            $new_record->save();
            $new_record->tipologies()->sync([1,8]);
        }
    }
}
