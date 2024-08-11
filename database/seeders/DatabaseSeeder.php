<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table('users')->insert([
            'name' => 'Admin Perpustakaan',
            'email' => 'adminperpustakaan@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('admin123'),
        ]);

        DB::table('users')->insert([
            'name' => 'gavi',
            'email' => 'gavi@gmail.com',
            'role' => 'user',
            'password' => Hash::make('gavi123'),
        ]);
    }
}
