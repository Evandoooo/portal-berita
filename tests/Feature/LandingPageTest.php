<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Category;
use App\Models\News;

// Menggunakan RefreshDatabase untuk membersihkan dan membuat ulang tabel
uses(RefreshDatabase::class);

test('halaman utama berhasil dimuat', function () {
    // LANGKAH 1: Buat data yang dibutuhkan oleh halaman utama
    // Karena halaman utama menampilkan berita, dan berita butuh kategori & user,
    // maka kita buat ketiganya.
    
    $user = User::factory()->create();
    $category = Category::factory()->create();
    
    // Buat setidaknya 1 berita agar halaman tidak error karena data kosong
    News::factory()->create([
        'user_id' => $user->id,
        'category_id' => $category->id,
    ]);

    // LANGKAH 2: Sekarang baru akses halamannya
    $response = $this->get('/');

    // LANGKAH 3: Pastikan statusnya 200 OK
    $response->assertStatus(200);
});