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
            [
                'name' => 'Miyazaki',
                'address' => 'Messina',
            ],
            [
                'name' => 'Arumi',
                'address' => 'Arona',
            ],
            [
                'name' => 'Magenta Sushi',
                'address' => 'Genova',
            ],
            [
                'name' => 'Sashimi Aruki',
                'address' => 'Livorno',
            ],
            [
                'name' => 'Sashimi Aruki',
                'address' => 'Livorno',
            ],
        ];
    }
}
