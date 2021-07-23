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
            "antipasti", 
            "primi",
            "secondi di carne",
            "secondi di pesce" , 
            "secondi vegetariani",
            "specialità" ,
            "piatti unici" , 
            "contorni",
            "street food", 
            "pizze" , 
            "bevande", 
            "vini", 
            "birre" , 
            "cocktails" , 
            "cocktails analcolici", 
            "amari" , 
            "frutta", 
            "desserts",
        ];

        foreach($categories as $category){

            $new_category = new Category();

            $new_category->name = $category;

            $new_category->save();

        }
    }
}

