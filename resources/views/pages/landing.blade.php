@extends('layouts.app')

@section('title', 'BeritaKita | Baca Berita Lebih Mudah')

@section('content')
<div class="bg-[#f6f8fc] min-h-screen px-4 md:px-10 lg:px-14 py-10">
  {{-- Komponen: Card Utama Horizontal --}}
  @foreach ($beritaPertama as $key => $item)
    @if ($key === 0)
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 mb-10">
        {{-- Berita Utama --}}
        <a href="{{ route('news.show', $item->slug) }}" class="lg:col-span-8 flex flex-col md:flex-row bg-white shadow-md border border-slate-200 rounded-xl overflow-hidden transition hover:shadow-lg">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-5 items-stretch p-4 w-full">
            {{-- Gambar --}}
            <div class="md:col-span-2">
              <img src="{{ asset('storage/' . $item->image) }}" alt="berita utama" class="w-full h-full object-cover rounded-xl hover:opacity-95 transition">
            </div>
            {{-- Konten --}}
            <div class="md:col-span-1 flex flex-col justify-between">
              <h2 class="font-semibold text-xl hover:underline transition mb-4">{!! Str::words($item->title, 8, '...') !!}</h2> 
              <p class="text-slate-600 text-sm text-gray-600">{{ $metaInfo($item) }}</p>
              <p class="font-normal text-base text-gray-600 mt-4">{!! Str::words($item->content, 26, '...') !!}</p>
            </div>
          </div>
        </a>

        {{-- Berita Pendamping --}}
        @if(isset($beritaPertama[1]))
          <a href="{{ route('news.show', $beritaPertama[1]->slug) }}" class="lg:col-span-4 bg-white shadow-md border border-slate-200 rounded-xl overflow-hidden p-4 flex flex-col transition hover:shadow-lg">
            <img src="{{ asset('storage/' . $beritaPertama[1]->image) }}" class="w-full h-40 object-cover rounded-lg mb-4 hover:opacity-95 transition">
            <h2 class="font-semibold text-xl hover:underline transition mb-4">{!! Str::words($beritaPertama[1]->title, 8, '...') !!}</h2> 
            <p class="text-slate-600 text-sm text-gray-600">{{ $metaInfo($beritaPertama[1]) }}</p>
            <p class="block lg:hidden font-normal text-base text-gray-600 mt-4">{!! Str::words($beritaPertama[1]->content, 26, '...') !!}</p>
          </a>
        @endif
      </div>
    @endif
  @endforeach

  {{-- Grid 4 Berita --}}
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-10">
    @foreach ($beritaGrid1 as $item)
      <a href="{{ route('news.show', $item->slug) }}" class="bg-white shadow-md border border-slate-200 rounded-xl overflow-hidden p-4 transition hover:shadow-lg">
        <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-40 object-cover rounded hover:opacity-95 transition">
        <div class="py-4 flex-1">
          <h2 class="font-semibold text-xl hover:underline transition mb-4">{!! Str::words($item->title, 8, '...') !!}</h2>
          <p class="text-slate-600 text-sm text-gray-600">{{ $metaInfo($item) }}</p>
          <p class="block lg:hidden font-normal text-base text-gray-600 mt-4">{!! Str::words($item->content, 26, '...') !!}</p>
        </div>
      </a>
    @endforeach
  </div>

  {{-- Kombinasi Berita Besar dan Kecil --}}
  <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 mb-10">
    @foreach ($beritaKedua as $key => $item)
      @if ($key === 0)
        {{-- Berita Kecil --}}
        <a href="{{ route('news.show', $item->slug) }}" class="lg:col-span-4 bg-white shadow-md border border-slate-200 rounded-xl overflow-hidden p-4 flex flex-col transition hover:shadow-lg">
          <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-40 object-cover rounded-lg mb-4 hover:opacity-95 transition">
          <h2 class="font-semibold text-xl hover:underline transition mb-4">{{ $item->title }}</h2>
          <p class="text-slate-600 text-sm text-gray-600">{{ $metaInfo($item) }}</p>
          <p class="block lg:hidden font-normal text-base text-gray-600 mt-4">{!! Str::words($item->content, 26, '...') !!}</p>
        </a>
      @else
        {{-- Berita Besar --}}
        <a href="{{ route('news.show', $item->slug) }}" class="lg:col-span-8 flex flex-col md:flex-row bg-white shadow-md border border-slate-200 rounded-xl overflow-hidden transition hover:shadow-lg">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-5 items-stretch p-4 w-full">
            <div class="md:col-span-2">
              <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-full object-cover rounded-xl hover:opacity-95 transition">
            </div>
            <div class="md:col-span-1 flex flex-col justify-between">
              <h2 class="font-semibold text-xl hover:underline transition mb-4">{!! Str::words($item->title, 8, '...') !!}</h2> 
              <p class="text-slate-600 text-sm text-gray-600">{{ $metaInfo($item) }}</p>
              <p class="font-normal text-base text-gray-600 mt-4">{!! Str::words($item->content, 26, '...') !!}</p>
            </div>
          </div>
        </a>
      @endif
    @endforeach
  </div>

  {{-- Grid 4 Berita Bawah --}}
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-10">
    @foreach ($beritaGrid2 as $item)
      <a href="{{ route('news.show', $item->slug) }}" class="bg-white shadow-md border border-slate-200 rounded-xl overflow-hidden p-4 transition hover:shadow-lg">
        <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-40 object-cover rounded hover:opacity-95 transition">
        <div class="py-4 flex-1">
          <h2 class="font-semibold text-xl hover:underline transition mb-4">{!! Str::words($item->title, 8, '...' ) !!}</h2>
          <p class="text-slate-600 text-sm text-gray-600">{{ $metaInfo($item) }}</p>
          <p class="block lg:hidden font-normal text-base text-gray-600 mt-4">{!! Str::words($item->content, 12, '...') !!}</p>
        </div>
      </a>
    @endforeach
  </div>

  {{-- FEATURED SECTION: Berita Unggulan --}}
  <div class="mb-10">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b-2 border-primary pb-2 inline-block">Berita Unggulan</h2>
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-5"> 
        @foreach ($featureds as $item)
          <a href="{{ route('news.show', $item->slug) }}"
            class=" bg-white shadow-md border border-slate-200 rounded-xl overflow-hidden flex flex-col lg:flex-row p-4 gap-4 hover:shadow-lg">
              <!-- Gambar -->
              <div class="w-full lg:w-1/2">
                  <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-48 object-cover rounded-lg shadow hover:opacity-95 transition-opacity">
                
              </div>
              <!-- Konten -->
              <div class="w-full lg:w-1/2 flex flex-col justify-between">
                  <h2 class="text-xl font-semibold mb-4 leading-tight hover:underline transition-colors">{!! Str::words($item->title, 8, '...') !!}</h2> {{-- Semi Bold 20px --}}
                  <p class="text-slate-600 text-sm text-gray-600">{{ $metaInfo($item) }}</p> {{-- Regular 16px --}}
                  <p class="font-normal text-base text-gray-600 mt-4">{!! Str::words($item->content, 15, '...') !!}</p> {{-- Regular 16px --}}
              </div>
          </a>
        @endforeach
      </div>
    
      {{-- Tombol "Selengkapnya" yang merutekan ke halaman berita unggulan --}}
        <div class="mt-8 text-center">
            <a href="{{ route('news.featured-news') }}"
              class="inline-block bg-white text-gray-800 font-bold py-2 px-4 rounded-lg  shadow-md hover:shadow-lg hover:bg-gray-50 transition-all duration-300">
                Selengkapnya
            </a>
        </div>
  </div>

</div>
@endsection
