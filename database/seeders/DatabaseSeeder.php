<?php

namespace Database\Seeders;

use App\Models\Service;
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
            'name' => 'admin',
            'is_admin' => true,
            'username' => 'admin01',
            'email' => 'admin01@gmail.com',
            'password' => bcrypt('admin01')
        ]);

        User::create([
            'name' => 'Kuroyasha',
            'is_admin' => true,
            'username' => 'Kuroyasha',
            'email' => 'Rickyandrean41@gmail.com',
            'password' => bcrypt('Ricky4424')
        ]);

        User::create([
            'name' => 'byy',
            'is_admin' => true,
            'username' => 'byy',
            'email' => 'byy@gmail.com',
            'password' => bcrypt('admin123')
        ]);

        Service::create([
            'nama' => 'Gudang',
        ]);

        Service::create([
            'nama' => 'Depo Container',
        ]);

        Service::create([
            'nama' => 'Collateral Management Service (CMS)',
        ]);

        Service::create([
            'nama' => 'Logistik',
        ]);
    }
}
