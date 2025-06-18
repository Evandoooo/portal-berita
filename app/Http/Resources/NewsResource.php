<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_berita' => $this->id,
            'judul' => $this->title,
            'penulis' => $this->user->name,
            'kategori' => $this->category->name,
            'isi_konten' => $this->content, 
            'tanggal_dibuat' => $this->created_at->format('d F Y H:i'),
        ];
    }
}
