<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index() 
    {
        $featureds = News::where('is_featured', true)
                         ->latest()
                         ->paginate(10); 
        
        // Ambil 12 berita terbaru
        $news = News::latest()->take(12)->get();

        // Potong menjadi bagian-bagian
        $beritaPertama = $news->slice(0, 2)->values();
        $beritaGrid1   = $news->slice(2, 4)->values();
        $beritaKedua   = $news->slice(6, 2)->values();
        $beritaGrid2   = $news->slice(8, 4)->values();

        
        // fungsi metaInfo 
        $metaInfo = function($item) {
            return $item->created_at->format('d M Y') . ' | ' . $item->category->name;
        };

        // Kirim ke view
        return view('pages.landing', compact(
            'featureds',
            'beritaPertama',
            'beritaGrid1',
            'beritaKedua',
            'beritaGrid2',
            'metaInfo'
        ));
    }
}
