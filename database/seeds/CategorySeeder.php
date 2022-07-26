<?php

use Illuminate\Database\Seeder;
use App\Category;
use Carbon\Carbon;

class CategorySeeder extends Seeder
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
       $number_of_insert = random_int($min_number, $max_number);

       foreach (range(1, $number_of_insert) as $index) {
           $this->input[] = $this->newInsertInput();
       }

       foreach (array_chunk($this->input, 2500) as $chunk){
           Category::insert($this->input);
       }
    }

    public function newInsertInput(): array
    {
        return factory(Category::class)->make([
            'created_at' =>  Carbon::now(),
            'updated_at' => Carbon::now(),
        ])->toArray();
    }
}
