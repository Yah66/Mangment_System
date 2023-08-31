<?php

namespace Database\Seeders;

use App\Post;
use App\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Postseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        for ($i = 1; $i <= 15; $i++) {

            Post::create([
                'user_id'   => User::inRandomOrder()->first()->id,
                'title'     => $faker->sentence(4),
                'body'      => $faker->paragraph(),
            ]);
        }
    }
}