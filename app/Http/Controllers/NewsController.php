<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function show($slug) 
    {
        $news = News::with(['comments.user', 'category'])->where('slug', $slug)->firstOrFail();
        $newests = News::where('id', '!=', $news->id)->latest()->take(5)->get();

        $metaInfo = function($item) {
            return $item->created_at->format('d M Y') . ' | ' . $item->category->name;
        };


        return view('pages.news.show', compact('news', 'newests', 'metaInfo'));
    }

    public function category($slug) 
    {
        $category = Category::where('slug', $slug)->first();

        $metaInfo = function($item) {
            return $item->created_at->diffForHumans() . ' | ' . $item->category->name;
        };


        return view('pages.news.category', compact('category', 'metaInfo'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');

        $results = News::with('category')
            ->where('title', 'like', "%{$query}%")
            ->orWhere('content', 'like', "%{$query}%")
            ->orWhereHas('category', function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })
            ->paginate(12); // Atur pagination jika perlu

        $metaInfo = function($item) {
            return $item->created_at->format('d M Y') . ' | ' . $item->category->name;
        };

        return view('pages.news.search-results', compact('results', 'query', 'metaInfo'));
    }

    public function save(News $news)
    {
        auth()->user()->savedNews()->syncWithoutDetaching([$news->id]);
        return back()->with('success', 'Berita disimpan.');
    }

    public function unsave(News $news)
    {
        auth()->user()->savedNews()->detach($news->id);
        return back()->with('success', 'Berita dihapus dari simpanan.');
    }

    public function loadFeaturedNews()
    {
        // Untuk halaman BERITA UNGGULAN: Ambil SEMUA berita unggulan dengan paginasi
        $allFeaturedNews = News::where('is_featured', true)
                               ->latest()
                               ->paginate(20); // Sesuaikan jumlah item per halaman di sini (misal 9 untuk 3x3 grid)

        $metaInfo = function($item) {
            return $item->created_at->format('d M Y') . ' | ' . $item->category->name;
        };

        return view('pages.news.featured-news', compact(
            'allFeaturedNews',
            'metaInfo'
        ));
    }   
}
