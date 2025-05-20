@extends('layouts.app')

@section('title', 'BeritaKita | Baca Berita Lebih Mudah')

@section('content')
<div class="px-4 md:px-10 lg:px-14 mt-10">
  {{-- SECTION 1: Berita Utama dan Satu Berita Pendukung --}}
  <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 mb-10">
    {{-- Berita Utama (col-span-8) --}}
    <a href="{{ route('news.show', $news[0]->slug) }}" class="lg:col-span-8 flex flex-col md:flex-row border border-slate-200 rounded-xl overflow-hidden hover:border-primary transition">
      {{-- Berita Utama dengan gambar terpisah --}}
      <div class="lg:col-span-8 grid grid-cols-1 md:grid-cols-3 gap-5 items-stretch border border-slate-200 rounded-xl overflow-hidden p-4">
        {{-- Gambar --}}
        <div class="md:col-span-2">
          <img src="{{ asset('storage/' . $news[0]->image) }}" alt="berita utama" class="w-full h-full object-cover rounded-xl">
        </div>

        {{-- Konten --}}
        <div class="md:col-span-1 flex flex-col justify-between">
          <div>
            <h2 class="text-2xl font-bold mb-1">{{ $news[0]->title }}</h2>
            <p class="text-sm text-gray-600 mb-4">{!! Str::limit($news[0]->content, 100) !!}</p>
          </div>
          <div class="text-sm text-gray-500 flex gap-3 mt-auto">
            <span>{{ $news[0]->created_at->format('d M Y') }}</span>
            <span>|</span>
            <span>{{ $news[0]->category->name }}</span>
          </div>
        </div>
      </div>
    </a>
    {{-- Satu Berita di Samping (col-span-4) --}}
    @if ($news->count() > 1)
      <a href="{{ route('news.show', $news[1]->slug) }}" class="lg:col-span-4 border border-slate-200 rounded-xl overflow-hidden p-4 hover:border-primary transition">
        <img src="{{ asset('storage/' . $news[1]->image) }}" class="w-full h-40 object-cover rounded x-1">
        <div class="py-4">
          <p class="font-semibold text-base mb-2">{{ $news[1]->title }}</p>
          <div class="block lg:hidden text-sm text-gray-600">
            {!! Str::limit($news[1]->content, 80) !!}
          </div>
          <p class="text-sm text-gray-500">{{ $news[1]->created_at->format('d M Y') }} | {{ $news[1]->category->name }}</p>
        </div>
      </a>
    @endif
  </div>

  {{-- SECTION 2: Grid Berita Bawah (4 kolom) --}}
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-10">
    @foreach ($news->skip(2)->take(4) as $item)
      <a href="{{ route('news.show', $item->slug) }}" class="border border-slate-200 rounded-xl overflow-hidden p-4 hover:border-primary transition">
        <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-40 object-cover rounded x-1">
        <div class="py-4">
          <p class="font-semibold text-base mb-2">{{ $item->title }}</p>
          <div class="block lg:hidden text-sm text-gray-600">
            {!! Str::limit($item->content, 80) !!}
          </div>
          <p class="text-sm text-gray-500">{{ $item->created_at->format('d M Y') }} | {{ $item->category->name }}</p>
        </div>
      </a>
    @endforeach
  </div>

  {{-- SECTION 3: Berita Unggulan Besar (2 kolom horizontal) --}}
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
    @foreach ($featureds as $index => $featured)
      <a href="{{ route('news.show', $featured->slug) }}" class="flex flex-col lg:flex-row border border-slate-200 rounded-xl overflow-hidden hover:border-primary transition">
        @if ($index % 2 === 0)
          <div class="lg:w-1/2">
            <img src="{{ asset('storage/' . $featured->image) }}" class="w-full h-full object-cover">
          </div>
        @endif
        <div class="p-5 lg:w-1/2">
          <p class="font-bold text-lg mb-2">{{ $featured->title }}</p>
          <p class="text-sm text-gray-500 mb-3">{{ $featured->created_at->format('d M Y') }} | {{ $featured->category->name }}</p>
          <p class="text-sm text-gray-600">{!! Str::limit($featured->content, 100) !!}</p>
        </div>
        @if ($index % 2 === 1)
          <div class="lg:w-1/2">
            <img src="{{ asset('storage/' . $featured->image) }}" class="w-full h-full object-cover">
          </div>
        @endif
      </a>
    @endforeach
  </div>
</div>
@endsection
