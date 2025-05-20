@extends('layouts.app')

@section('title', 'Berita yang Disimpan')

@section('content')
    <!-- Hero Section -->
    <div class="w-full mb-16 bg-[#F6F6F6]">
        <h1 class="text-center font-bold text-2xl p-24">Berita yang Disimpan</h1>
    </div>

    <!-- Saved News Section -->
    <div class="flex flex-col gap-5 px-4 lg:px-14 mb-24">
        @if($savedNews->isEmpty())
            <p class="text-center text-gray-500 text-sm">Belum ada berita yang disimpan.</p>
        @else
            <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach ($savedNews as $news)
                    <a href="{{ route('news.show', $news->slug) }}" class="group relative block rounded-xl border border-slate-200 p-3 hover:border-primary transition duration-300 ease-in-out">
                        <div class="absolute top-2 left-2 bg-primary text-white rounded-full px-4 py-1 text-sm">
                            {{ $news->category->name }}
                        </div>
                        <img src="{{ asset('storage/' . $news->image) }}"
                             alt="{{ $news->title }}"
                             class="w-full h-48 object-cover rounded-lg mb-3">
                        <h2 class="font-bold text-base mb-1 group-hover:text-primary transition">{{ $news->title }}</h2>
                        <p class="text-slate-400 text-sm">
                            {{ \Carbon\Carbon::parse($news->created_at)->translatedFormat('d F Y') }}
                        </p>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endsection
