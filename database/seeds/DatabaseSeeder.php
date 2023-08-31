<?php

use Database\Seeders\Postseeder;
use Database\Seeders\Userseeder;
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
        $this->call(Userseeder::class);
        // $this->call(Postseeder::class);
    }
}