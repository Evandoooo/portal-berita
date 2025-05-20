@extends('layouts.app')

@section('title', $news->title)

@section('content')
    <!-- Detail Berita -->
    <div class="flex flex-col px-4 lg:px-14 mt-10">
        <!-- Judul & Metadata -->
        <div class="mb-6 text-center lg:text-left">
            <h1 class="text-2xl lg:text-3xl font-bold mb-2">{{ $news->title }}</h1>
            <div class="text-sm text-slate-500 flex lg:justify-start items-center gap-2">
                <span>{{ \Carbon\Carbon::parse($news->created_at)->format('d M Y') }}</span> |
                <span>{{ $news->category->name ?? 'Uncategorized' }}</span>
            </div>
        </div>

        <!-- Bagian Share -->
        <div class="flex justify-between items-center mb-6">
            <div class="flex gap-3 items-center">
                <span class="font-semibold text-sm">Bagikan:</span>
                @php $url = urlencode(request()->fullUrl()); @endphp

                <a href="https://wa.me/?text={{ $url }}" target="_blank" title="Bagikan ke WhatsApp">
                    <img src="{{ asset('assets/img/icons/whatsapp.png') }}" class="w-5" alt="WhatsApp">
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}" target="_blank" title="Bagikan ke Facebook">
                    <img src="{{ asset('assets/img/icons/facebook.png') }}" class="w-5" alt="Facebook">
                </a>
                <a href="https://t.me/share/url?url={{ $url }}" target="_blank" title="Bagikan ke Telegram">
                    <img src="{{ asset('assets/img/icons/telegram.png') }}" class="w-5" alt="Telegram">
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ $url }}&text={{ urlencode($news->title) }}" target="_blank" title="Bagikan ke Twitter/X">
                    <img src="{{ asset('assets/img/icons/x.png') }}" class="w-5" alt="Twitter">
                </a>
                <button onclick="navigator.clipboard.writeText('{{ request()->fullUrl() }}')" title="Salin Tautan">
                    <img src="{{ asset('assets/img/icons/link.png') }}" class="w-5" alt="Salin Tautan">
                </button>
            </div>

            @auth
            <div class="text-sm text-slate-500">
                @if(auth()->user()->savedNews->contains($news->id))
                    <form action="{{ route('news.unsave', $news->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Hapus Simpanan</button>
                    </form>
                @else
                    <form action="{{ route('news.save', $news->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="hover:underline">Simpan Berita</button>
                    </form>
                @endif
            </div>
            @endauth
        </div>


        <!-- Isi & Sidebar -->
        <div class="flex flex-col lg:flex-row w-full gap-10">
            <!-- Berita Utama -->
            <div class="lg:w-8/12">
                <img src="{{ asset('storage/' . $news->image) }}" alt="gambar" class="w-full max-h-96 rounded-xl object-cover mb-6">
                <div class="prose max-w-full prose-sm lg:prose-base prose-slate">
                    {!! $news->content !!}
                </div>
            </div>

            <!-- Berita Terbaru -->
            <div class="lg:w-4/12 flex flex-col gap-10">
                <div class="sticky top-24 z-40">
                    <p class="font-bold mb-8 text-xl lg:text-2xl">Berita Terbaru Lainnya</p>
                    <div class="gap-5 flex flex-col">
                        @foreach ($newests as $new)
                            <a href="{{ route('news.show', $new->slug) }}">
                                <div class="flex gap-3 border border-slate-300 hover:border-primary p-3 rounded-xl">
                                    <div class="flex gap-3 flex-col">
                                        <img src="{{ asset('storage/' . $new->image) }}" class="w-full h-40 object-cover rounded-xl">
                                        <p class="font-bold text-sm lg:text-base">{{ $new->title }}</p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
