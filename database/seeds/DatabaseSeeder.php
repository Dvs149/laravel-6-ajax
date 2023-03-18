<?php

use App\Product;
use App\Category;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        // $this->call(UsersTableSeeder::class);
        for ($i=0; $i < 100; $i++) { 
            $category = new Category;
            $category->name = $faker->text;
            $category->parent_id = factory('App\Category')->create()->id ;
            $category->save();
        }
        for ($i=0; $i < 100; $i++) { 
            $product = new Product;
            $product->name = $faker->text;
            $product->description = $faker->text;
            $product->cat_id = factory('App\Category')->create()->id ;
            $product->save();
        }
    }
}
