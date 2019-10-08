<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i = 0; $i < 20; $i++) {
            $product = new Product();
            $product->product_name = $faker->text(15);
            $product->product_sku = $faker->randomNumber(6);
            $product->product_price = $faker->numberBetween(1, 1000);
            $product->product_description = $faker->text(100);
            $product->product_image = $faker->imageUrl(300, 300, 'technics');
            $product->save();
        }
    }
}
