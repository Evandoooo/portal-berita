@extends('layouts.app')

@section('title', 'Semua Berita Unggulan | BeritaKita')

@section('content')
<div class="bg-gradient-to-b from-[#f6f8fc] to-white min-h-screen px-4 md:px-10 lg:px-14 py-10">

    <h1 class="text-3xl font-bold text-gray-800 mb-8 pb-3 inline-block">Semua Berita Unggulan</h1>

    <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-10"> 
        @if($allFeaturedNews->isEmpty())
            <p class="text-center text-gray-500 text-base col-span-full">Belum ada berita unggulan yang tersedia.</p>
        @else
            @foreach ($allFeaturedNews as $news) 
                <a href="{{ route('news.show', $news->slug) }}"
                   class="group relative block rounded-xl  bg-white shadow-md border border-slate-200 p-3 hover:border-primary transition  hover:shadow-lg">
                    <img src="{{ asset('storage/' . $news->image) }}" alt="" class="w-full h-40 object-cover rounded-lg mb-4 hover:opacity-95 transition"
                        style="object-fit: cover;">
                    <h2 class="font-semibold text-xl hover:underline transition mb-4">{!! Str::words($news->title, 8, '...') !!}</h2> 
                    <p class="text-sm text-gray-600">{{ $metaInfo($news) }}</p>
                    <p class="block lg:hidden font-normal text-sm text-gray-600 mt-4">{!! Str::words(strip_tags($news->content), 10, '...') !!}</p>
                </a>
            @endforeach
        @endif
    </div>

    <div class="mt-8">
        {{ $allFeaturedNews->links() }}
    </div>
</div>
@endsection
