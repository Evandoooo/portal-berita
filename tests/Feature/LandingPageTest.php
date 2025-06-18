<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Category;
use App\Models\News;

uses(RefreshDatabase::class);

test('halaman utama berhasil dimuat', function () {

    $user = User::factory()->create();
    $category = Category::factory()->create();
    
    News::factory()->create([
        'user_id' => $user->id,
        'category_id' => $category->id,
    ]);

    $response = $this->get('/');

    $response->assertStatus(200);
});