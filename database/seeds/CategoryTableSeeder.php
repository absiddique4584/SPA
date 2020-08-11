<?php

use Illuminate\Database\Seeder;
use App\Category;
class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        foreach (range(1,10) as $index){
            $category = $faker->unique()->name;
            Category::create([
                'cat_name' => $category,
            ]);
        }
    }
}
