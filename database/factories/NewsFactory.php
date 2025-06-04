<?php

namespace Database\Factories;

use App\Models\News;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = News::class;

    public function definition(): array
    {
        $title = $this->faker->sentence();
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'title' => $title,
            'slug' => Str::slug($title) . '-' . Str::random(5),
            'content' => $this->faker->paragraphs(20, true), // ±200 kata
            'is_featured' => $this->faker->boolean(30),
            'image' => $this->faker->image('public/storage', 640, 480, null, false),
        ];
    }
}
