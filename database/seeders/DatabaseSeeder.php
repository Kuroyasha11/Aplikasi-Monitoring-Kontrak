<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Kuroyasha',
            'slug' => 'kuroyasha',
            'email' => 'Rickyandrean41@gmail.com',
            'password' => 'Ricky4424'
        ]);

        // DATA FARABY
        // User::create([
        //     'name' => '',
        //     'slug' => '',
        //     'email' => '',
        //     'password' => ''
        // ]);
    }
}
