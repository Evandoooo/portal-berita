<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function show($slug) 
    {
        $news = News::where('slug', $slug)->firstOrFail();
        $newests = News::where('id', '!=', $news->id)->latest()->take(5)->get();

        return view('pages.news.show', compact('news', 'newests'));
    }


    public function category($slug) 
    {
        $category = Category::where('slug', $slug)->first();

        return view('pages.news.category', compact('category'));
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
            ->paginate(10); // Atur pagination jika perlu

        return view('pages.news.search-results', compact('results', 'query'));
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
}
