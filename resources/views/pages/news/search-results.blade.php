@extends('layouts.app')

@section('title', 'Hasil Pencarian')

@section('content')
    <div class="w-full mb-16 bg-[#F6F6F6]">
        <h1 class="text-center font-bold text-2xl p-24">Hasil Pencarian: "{{ $query }}"</h1>
    </div>

    <div class="flex flex-col gap-5 px-4 lg:px-14 pb-10">
        @if ($results->count())
            <div class="grid sm:grid-cols-1 gap-5 lg:grid-cols-4">
                @foreach ($results as $news)
                    <a href="{{ route('news.show', $news->slug) }}">
                        <div class="border border-slate-200 p-3 rounded-xl hover:border-primary hover:cursor-pointer transition duration-300 ease-in-out relative"
                            style="height: 100%;">
                            <div class="bg-primary text-white rounded-full w-fit px-5 py-1 font-normal ml-2 mt-2 text-sm absolute z-10">
                                {{ $news->category->name ?? 'Tanpa Kategori' }}
                            </div>
                            <img src="{{ asset('storage/' . $news->image) }}" alt="" class="w-full rounded-xl mb-3"
                                style="height: 200px; object-fit: cover;">
                            <p class="font-bold text-base mb-1">{{ $news->title }}</p>
                            <p class="text-slate-400 text-sm">{{ \Carbon\Carbon::parse($news->created_at)->format('d F Y') }}</p>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $results->withQueryString()->links() }}
            </div>
        @else
            <p class="text-center text-gray-600">Tidak ada hasil ditemukan untuk pencarian "<strong>{{ $query }}</strong>".</p>
        @endif
    </div>
@endsection
