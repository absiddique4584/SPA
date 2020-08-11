<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
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
            User::create([
                'name' => $faker->name ,
                'email' => $faker->email ,
                'password' =>bcrypt('12345678')
            ]);
        }
    }
}
