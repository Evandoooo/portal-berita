<?php

use App\Models\News;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('api daftar berita mengembalikan status sukses dan struktur json yang benar', function () {
    News::factory()->create();

    $response = $this->get('/api/news');

    $response
        ->assertStatus(200) 
        ->assertJsonStructure([ 
            'data' => [
                '*' => [ 
                    'id_berita',
                    'judul',
                    'penulis',
                    'kategori',
                    'isi_konten',
                    'tanggal_dibuat',
                ]
            ],
            'links', 
            'meta',  
        ]);
});