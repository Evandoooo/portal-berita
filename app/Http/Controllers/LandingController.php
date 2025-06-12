<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LandingController extends Controller
{
    public function index() 
    {
        // 1. Cache untuk featured news (dengan paginasi)
        $featureds = Cache::remember('featured_news_page_' . request('page', 1), 600, function () {
            // Query ini hanya akan jalan jika cache kosong atau sudah kedaluwarsa (10 menit)
            return News::where('is_featured', true)
                         ->with(['user', 'category']) // Tambahkan eager loading untuk efisiensi
                         ->latest()
                         ->paginate(10);
        }); 
        
        // 2. Cache untuk 12 berita terbaru
        $news = Cache::remember('latest_12_news', 600, function () {
            // Query ini hanya akan jalan jika cache 'latest_12_news' kosong
            return News::with(['user', 'category']) // Eager load relasi sebelum caching
                         ->latest()
                         ->take(12)
                         ->get();
        });
        
        // 2. AMBIL DATA KATEGORI DI SINI
        $categories = Category::all();

        // Potong menjadi bagian-bagian
        $beritaPertama = $news->slice(0, 2)->values();
        $beritaGrid1   = $news->slice(2, 4)->values();
        $beritaKedua   = $news->slice(6, 2)->values();
        $beritaGrid2   = $news->slice(8, 4)->values();

        
        // fungsi metaInfo 
        $metaInfo = function($item) {
            return $item->created_at->diffForHumans() . ' | ' . $item->category->name;
        };

        // Kirim ke view
        return view('pages.landing', compact(
            'featureds',
            'beritaPertama',
            'beritaGrid1',
            'beritaKedua',
            'beritaGrid2',
            'metaInfo',
            'categories'
        ));
    }
}
