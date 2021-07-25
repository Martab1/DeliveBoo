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
    }
}
