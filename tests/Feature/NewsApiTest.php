<?php

use App\Models\News;
use Illuminate\Foundation\Testing\RefreshDatabase;

// Menggunakan RefreshDatabase untuk membersihkan database di setiap test
uses(RefreshDatabase::class);

test('api daftar berita mengembalikan status sukses dan struktur json yang benar', function () {
    // 1. Buat 1 data berita palsu menggunakan factory
    News::factory()->create();

    // 2. Simulasikan permintaan GET ke endpoint API
    $response = $this->get('/api/news');

    // 3. Lakukan beberapa assertion untuk memastikan API berfungsi
    $response
        ->assertStatus(200) // Pastikan statusnya 200 OK
        ->assertJsonStructure([ // Pastikan struktur JSON-nya benar
            'data' => [
                '*' => [ // Tanda '*' berarti setiap item di dalam array 'data'
                    'id_berita',
                    'judul',
                    'penulis',
                    'kategori',
                    'isi_konten',
                    'tanggal_dibuat',
                ]
            ],
            'links', // Pastikan ada object links untuk paginasi
            'meta',  // Pastikan ada object meta untuk paginasi
        ]);
});