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
        $featureds = Cache::remember('featured_news_page_' . request('page', 1), 600, function () {
            return News::where('is_featured', true)
                         ->with(['user', 'category']) 
                         ->latest()
                         ->paginate(10);
        }); 
        
        $news = Cache::remember('latest_12_news', 600, function () {
            return News::with(['user', 'category']) 
                         ->latest()
                         ->take(12)
                         ->get();
        });
        
        $categories = Category::all();

        $beritaPertama = $news->slice(0, 2)->values();
        $beritaGrid1   = $news->slice(2, 4)->values();
        $beritaKedua   = $news->slice(6, 2)->values();
        $beritaGrid2   = $news->slice(8, 4)->values();

        $metaInfo = function($item) {
            return $item->created_at->diffForHumans() . ' | ' . $item->category->name;
        };

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
