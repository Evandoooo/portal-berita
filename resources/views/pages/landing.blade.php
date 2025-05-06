@extends('layouts.app')

@section('title', 'BeritaKita | Baca Berita Lebih MUdah')

@section('content')
    <!-- Berita Terbaru -->
    <div class="flex flex-col px-4 md:px-10 lg:px-14 mt-10">
      <div class="flex flex-col md:flex-row w-full mb-6">
        <div class="font-bold text-2xl text-center md:text-left">
          <p>Berita Terbaru</p>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-12 gap-5">
        <!-- Berita Utama -->
        <div
          class="relative col-span-7 lg:row-span-3 border border-slate-200 p-3 rounded-xl hover:border-primary hover:cursor-pointer">
          <a href="{{ route('news.show', $news[0]->slug) }}">
            <div class="bg-primary text-white rounded-full w-fit px-4 py-1 font-normal ml-5 mt-5 absolute">
              {{ $news[0]->category->name }}
            </div>
            <img src="{{ asset('storage/' . $news[0]->image) }}" alt="berita1" class="rounded-2xl">
            <p class="font-bold text-xl mt-3">
              {{ $news[0]->title }} </p>
            <p class="text-slate-400 text-base mt-1">
              {!! \Str::limit($news[0]->content, 100) !!}
            </p>
            <p class="text-slate-400 text-base mt-1">{{ \Carbon\Carbon::parse($news[0]->created_at)->format('d F Y') }}</p>
          </a>
        </div>

        <!-- Berita 1 -->
        @foreach ( $news->skip(1) as $new )
          <a href="{{ route('news.show', $new->slug) }}"
            class="relative col-span-5 flex flex-col h-fit md:flex-row gap-3 border border-slate-200 p-3 rounded-xl hover:border-primary hover:cursor-pointer">
            <div class="bg-primary text-white rounded-full w-fit px-4 py-1 font-normal ml-2 mt-2 absolute text-sm">
            {{ $new->category->name }}</div>
            <img src="{{ asset('storage/' . $new->image) }}" alt="berita2" 
              class="rounded-xl md:max-h-48" style="width: 250px; object-fit: cover;">
            <div class="mt-2 md:mt-0">
              <p class="font-semibold text-lg">{{ $new->title }}</p>
              <p class="text-slate-400 mt-3 text-sm font-normal">{!! \Str::limit($new->content, 100) !!}</p>
            </div>
          </a>
        @endforeach
      </div>

    </div>

    <!-- Berita Unggulan -->
    <div class="flex flex-col px-14 mt-10 ">
      <div class="flex flex-col md:flex-row justify-between items-center w-full mb-6">
        <div class="font-bold text-2xl text-center md:text-left">
          <p>Berita Unggulan</p>
          <p>Untuk Kamu</p>
        </div>
        <a href="semuaberita.html"
          class="bg-primary px-5 py-2 rounded-full text-white font-semibold mt-4 md:mt-0 h-fit">
          Lihat Semua
        </a>
      </div>
      <div class="grid sm:grid-cols-1 gap-5 lg:grid-cols-4">
        @foreach ($featureds as $featured)
          <a href="{{ route('news.show', $featured->slug) }}">
            <div
              class="border border-slate-200 p-3 rounded-xl hover:border-primary hover:cursor-pointer transition duration-300 ease-in-out">
              <div class="bg-primary text-white rounded-full w-fit px-5 py-1 font-normal ml-2 mt-2 text-sm absolute">
                {{ $featured->category->name }}
              </div>
              <img src="{{ asset('storage/' . $featured->image) }}" alt="gambar berita" 
                class="w-full rounded-xl mb-3" style="height: 150px; object-fit: cover;">
              <p class="font-bold text-base mb-1">{{ $featured->title }}</p>
              <p class="text-slate-400">{{ \Carbon\Carbon::parse($featured->created_at)->format('d F Y') }}</p>
            </div>
          </a>
        @endforeach
      </div>
    </div>
@endsection