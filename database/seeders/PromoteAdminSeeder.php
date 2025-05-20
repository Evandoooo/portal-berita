<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class PromoteAdminSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::find(1);

        if ($user) {
            $user->role = 'admin';
            $user->save();
        }
    }
}
