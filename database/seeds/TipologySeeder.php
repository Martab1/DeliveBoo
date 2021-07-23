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
            "italiano", "giapponese" , "messicano" , "cinese", "indiano" , 
            "arabo" , "thailandese" , "pizzeria" , "steakhouse" , "fastfood"
            , "fusion" , "paninoteca" , "ramen-ya" , "bistrot", "tavola calda",
            "buffet", "osteria" , "taverna" , "greco", "trattoria", 
            "teppanyaki-ya", "kosher", "kebab", "gelateria", "pub" , "pasticceria",
            "speakeasy", "birreria", "fritti" , "nepalese", "poke", "rosticceria", 
            "vietnamita", "vegano" , "vegetariano", "tex-mex"
        ];

        sort($tipologies);

        foreach($tipologies as $tipology){

            $new_tipology = new Tipology();
            
            $new_tipology->name = $tipology;

            $new_tipology->save();

        }
    }

}
