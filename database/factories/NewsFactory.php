<?php

namespace Database\Factories;

use App\Models\News;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NewsFactory extends Factory
{
    protected $model = News::class;

    public function definition(): array
    {
        $title = $this->faker->sentence();
        return [
            'user_id' => User::factory(),    
            'category_id' => Category::factory(), 

            'title' => $title,
            'slug' => Str::slug($title), 
            'content' => $this->faker->paragraphs(10, true),
            'is_featured' => $this->faker->boolean(20),
            'image' => 'images/dummy-image.jpg',
        ];
    }
}