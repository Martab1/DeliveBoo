<?php

use App\Tipology;
use Illuminate\Database\Seeder;

class TipologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipologies = [
            "italiano", "giapponese" , "messicano" , 
            "cinese", "indiano" , "poke" , 
            "thailandese" , "pizzeria" , "fastfood", 
            "osteria" , "greco", "trattoria", 
            "vietnamita" , "kebab",  "pub" , 
            "pasticceria", "birreria", "vegetariano",  
        ];

        sort($tipologies);

        foreach($tipologies as $tipology){

            $new_tipology = new Tipology();
            
            $new_tipology->name = $tipology;

            $new_tipology->save();

        }
    }

}
