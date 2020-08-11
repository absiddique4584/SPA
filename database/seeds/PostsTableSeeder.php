<?php

use Illuminate\Database\Seeder;
use App\Post;
class PostsTableSeeder extends Seeder
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
            Post::create([
                'cat_id'=>rand(1,10),
                'user_id'=>rand(1,10),
                'comment_id'=>rand(1,10),
                'title'=>$faker->sentence,
                'description'=>$faker->paragraph,
                'photo' => $this->getRandomImage(),
            ]);
        }

    }
    public function getRandomImage(){
        $images = array('book1.jpg','book2.jpg','book3.jpg');
        return $images[array_rand($images)];
    }
}
