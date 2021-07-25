<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pizzeria = [

            /**** Pizzeria ****/
            // Antipasti
            [
                'name' => 'Alette di pollo',
                'description' => 'Sezioni di ali di pollo fritte e immerse in un condimento composto da salsa al pepe di Caienna e burro fuso.',
                'price' => '4.00',
                'visibility' => 1,
                'category_id' => 1,
            ],
            [
                'name' => 'Anelli di cipolla',
                'description' => 'Anello di cipolla tagliato trasversalmente e intinto nella pastella o nel pangrattato e poi fritto in profondità.',
                'price' => '3.00',
                'visibility' => 1,
                'category_id' => 1,
            ],
            [
                'name' => 'Fritto Misto',
                'description' => 'Fritto misto composto da patate, crocchette di alta qualità e saporite panelle.',
                'price' => '3.00',
                'visibility' => 1,
                'category_id' => 1,
            ],
            [
                'name' => 'Crocchè',
                'description' => 'si compone di un impasto di patate, uova, formaggio, prezzemolo, pepe e farcitura di fior di latte.',
                'price' => '3.00',
                'visibility' => 1,
                'category_id' => 1,
            ],
            [
                'name' => 'Patatine Fritte',
                'description' => 'Porzione di patate tagliate a fette di forma allungata e fritte in olio di girasole alto oleico.',
                'price' => '2.00',
                'visibility' => 1,
                'category_id' => 1,
            ],
            // Pizze
            [
                'name' => 'Americana',
                'description' => 'Mozzarella, würstel e patate fritte.',
                'price' => '7.00',
                'visibility' => 1,
                'category_id' => 10,
            ],
            [
                'name' => 'Boscaiola',
                'description' => 'Mozzarella, champignon e salsiccia a fette',
                'price' => '9.00',
                'visibility' => 1,
                'category_id' => 10,
            ],
            [
                'name' => 'Capricciosa',
                'description' => 'Pomodoro, mozzarella, funghi, carciofi, prosciutto e olive nere.',
                'price' => ' 7.00',
                'visibility' => 1,
                'category_id' => 10,
            ],
            [
                'name' => 'Diavola',
                'description' => 'Pomodoro, mozzarella, salame piccante, peperoncino e olive nere. ',
                'price' => '7.00',
                'visibility' => 1,
                'category_id' => 10,
            ],
            [
                'name' => 'Margherita',
                'description' => 'Pomodoro, mozzarella, basilico fresco, sale e olio',
                'price' => '5.00',
                'visibility' => 1,
                'category_id' => 10,
            ],
            [
                'name' => 'Marinara',
                'description' => 'Pomodoro, aglio, origano e olio.',
                'price' => '4.00',
                'visibility' => 1,
                'category_id' => 10,
            ],
            [
                'name' => 'Pistacchio e mortadella',
                'description' => 'Pizza Gourmet con mortadella, pesto genovese, pistacchio e funghi porcini. ',
                'price' => '10.00',
                'visibility' => 1,
                'category_id' => 10,
            ],
            [
                'name' => 'Primavera',
                'description' => 'Pomodoro, mozzarella, funghi, carciofi, prosciutto e olive nere. ',
                'price' => '6.00',
                'visibility' => 1,
                'category_id' => 10,
            ],
            [
                'name' => 'Prosciutto e funghi',
                'description' => 'Pomodoro, mozzarella, champignon e prosciutto cotto. ',
                'price' => '8.00',
                'visibility' => 1,
                'category_id' => 10,
            ],
            [
                'name' => 'Quattro formaggi',
                'description' => 'Mozzarella, formaggi vari, basilico e gorgonzola.',
                'price' => '6.00',
                'visibility' => 1,
                'category_id' => 6,
            ],
            [
                'name' => 'Quattro stagioni',
                'description' => 'Pomodoro, mozzarella, funghi, carciofi, prosciutto e olive nere.',
                'price' => '7.00',
                'visibility' => 1,
                'category_id' => 10,
            ],
            [
                'name' => 'Tonno e olive',
                'description' => 'Pomodoro, mozzarella, tonno e olive nere.',
                'price' => '6.00',
                'visibility' => 1,
                'category_id' => 10,
            ],
            // Bevande
            [
                'name' => 'Acqua naturale',
                'price' => '1.00',
                'visibility' => 1,
                'category_id' => 11,
                'description' => '',
            ],
            [
                'name' => 'Acqua frizzante',
                'price' => '1.00',
                'description' => '',
                'visibility' => 1,
                'category_id' => 11,
            ],
            [
                'name' => 'Chinò',
                'price' => '2.00',
                'description' => '',
                'visibility' => 1,
                'category_id' => 11,
            ],
            [
                'name' => 'Coca cola',
                'price' => '3.00',
                'description' => '',
                'visibility' => 1,
                'category_id' => 11,
            ],
            [
                'name' => 'Fanta',
                'price' => '3.00',
                'visibility' => 1,
                'description' => '',
                'category_id' => 11,
            ],
            // Birre
            [
                'name' => 'Ceres',
                'description' => 'Gradazione Alcolica: 7,7% vol.',
                'price' => '4.00',
                'visibility' => 1,
                'category_id' => 13,
            ],
            [
                'name' => 'Faxe',
                'description' => 'Gradazione Alcolica: 10,0% vol.',
                'price' => '4.00',
                'visibility' => 1,
                'category_id' => 13,
            ],
            [
                'name' => 'Heineken',
                'description' => 'Gradazione Alcolica: 5,0% vol.',
                'price' => '3.00',
                'visibility' => 1,
                'category_id' => 13,
            ],
            [
                'name' => 'Messina',
                'description' => ' Gradazione Alcolica: 5,0% vol.',
                'price' => '3.00',
                'visibility' => 1,
                'category_id' => 13,
            ],
            [
                'name' => "Tennent's",
                'description' => 'Gradazione Alcolica: 9,0% vol.',
                'price' => '4.00',
                'visibility' => 1,
                'category_id' => 13,
            ],
        ];

       $Sushi = [
            /**** Giapponese ****/
            // Antipasti
            [
                'name' => 'Alghe wakame',
                'description' => 'Insalata di alghe wakame',
                'price' => '3.00',
                'visibility' => 1,
            ],
            [
                'name' => 'Ebi gyoza',
                'description' => 'Ravioli di gamberetti al vapore',
                'price' => '4.00',
                'visibility' => 1,
            ],
            [
                'name' => 'Edamame',
                'description' => 'Fagioli di soia bolliti.',
                'price' => '3.00',
                'visibility' => 1,
            ],

            [
                'name' => 'Zuppa di miso',
                'description' => 'Zuppa di soia con alghe e tofu',
                'price' => '3.00',
                'visibility' => 1,
            ],
            // Primi
            [
                'name' => 'Yasai yaki meshi',
                'description' => 'Riso saltato con verdure e uova',
                'price' => '6.00',
                'visibility' => 1,
            ],
            [
                'name' => 'Yasai yaki udon',
                'description' => 'Spaghetti saltati con verdure e uova',
                'price' => '6.00',
                'visibility' => 1,
            ],
            [
                'name' => 'Ebi yaki soba',
                'description' => 'Spaghetti di grano saraceno  con verdure e uova',
                'price' => '7.00',
                'visibility' => 1,
            ],
            [
                'name' => 'Ebi yaki soba',
                'description' => 'Spaghetti saltati con pollo e verdure',
                'price' => '7.00',
                'visibility' => 1,
            ],
        ];


        for($i = 1; $i<10 ; $i++){
            foreach ($pizzeria as $product) {
                $new_product = new Product;
                

                $new_product->name = $product['name'];
                $new_product->description = $product['description'];
                $new_product->price = $product['price'];
                $new_product->visibility = $product['visibility'];
                $new_product->category_id = $product['category_id'];
                $new_product->restaurant_id = $i;
                $new_product->image = 'ciao';

                $new_product->save();
            }
        };
    }
}
