<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Product;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    public $input = [];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $min_number = 2;
      $max_number = 10;
      $categories = Category::all();
      foreach ($categories as $category){
         $number_of_insert = random_int($min_number, $max_number);
         $this->insertManyToInput($number_of_insert, $category);
      }
      foreach (array_chunk($this->input, 2500) as $chunk){
         Product::insert($this->input);
      }

      $products = Product::all();
      $tags=["tag1","tag2","tag3","tag4","tag5"];
      foreach ($products as $product)
      {
        $keys = array_rand($tags,3);
        $tags_random = [
          ["name"=>$tags[$keys[0]]],
          ["name"=>$tags[$keys[1]]],
          ["name"=>$tags[$keys[2]]],
        ];
        $product->productTags()->createMany($tags_random);
      }


     }

     public function insertManyToInput($number_of_insert, $category)
     {
        for ($i = $number_of_insert; $i > 0; $i--) {
            $this->input[] = $this->newInsertInput($category);
        }
     }

     public function newInsertInput($category)
     {
          return factory(Product::class)->make([
              'category_id' => $category->id,
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
          ])->toArray();
     }

}
