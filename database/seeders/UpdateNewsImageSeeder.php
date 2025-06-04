<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;

class UpdateNewsImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        News::query()->update(['image' => 'placeholder.jpg']);
    }
}
