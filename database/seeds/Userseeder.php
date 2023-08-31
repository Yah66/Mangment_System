<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // User::create([
        //     'name' => 'yahia',
        //     'email' => 'ya@gmail.com',
        //     'password' => bcrypt('Ya123456')
        // ]);

        User::create(['name' => "yahia",
            'email' => 'yahia0halaby@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        User::create([
            'name' => "yahia",
            'email' => 'yahia.a.alhalby@students.iugaza.edu.ps',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);


    }
}