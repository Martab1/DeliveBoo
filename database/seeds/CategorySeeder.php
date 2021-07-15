<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $categories = [
            "antipasti", "primi", "frutta", "dessert", 
            "street food", "pizze" , "piatti unici" , "specialità" ,
            "secondi di carne" , "secondi di pesce" , "secondi vegetariani" , "contorni",
            "amari" , "vini", "birre" , "cocktails" , "cocktails analcolici", "bevande",
        ];

        foreach($categories as $category){

            $new_category = new Category();

            $new_category->name = $category;

            $new_category->save();

        }
    }
}
