<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        User::create([
            'name' => 'AdminBaru',
            'email' => 'adminbaru@example.com',
            'password' => Hash::make('admin1512'),
            'role' => 'admin',  // pastikan kolom role ada di tabel users
        ]);

        User::create([
            'name' => 'UserBiasa',
            'email' => 'user@example.com',
            'password' => Hash::make('user1512'),
            'role' => 'user',
        ]);
    }
}
