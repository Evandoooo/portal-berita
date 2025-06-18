@extends('layouts.app')

@section('title', $news->title)

@section('content')
    <div class="flex flex-col px-4 lg:px-14 mt-10">
        <div class="mb-6 text-center lg:text-left">
            <h1 class="font-semibold text-2xl lg:text-3xl mb-4">{{ $news->title }}</h1> 
            <p class="text-slate-600 text-sm flex lg:justify-start items-center gap-2">{{ $metaInfo($news) }}</p>
        </div>

        <div class="flex justify-between items-center mb-6">
            <div class="flex gap-3 items-center">
                <span class="font-semibold text-sm">Bagikan:</span>
                @php $url = urlencode(request()->fullUrl()); @endphp

                <a href="https://wa.me/?text={{ $url }}" target="_blank" title="Bagikan ke WhatsApp">
                    <img src="{{ asset('assets/img/icons/whatsapp.png') }}" class="w-8" alt="WhatsApp">
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}" target="_blank" title="Bagikan ke Facebook">
                    <img src="{{ asset('assets/img/icons/facebook.png') }}" class="w-8" alt="Facebook">
                </a>
                <a href="https://t.me/share/url?url={{ $url }}" target="_blank" title="Bagikan ke Telegram">
                    <img src="{{ asset('assets/img/icons/telegram.png') }}" class="w-8" alt="Telegram">
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ $url }}&text={{ urlencode($news->title) }}" target="_blank" title="Bagikan ke Twitter/X">
                    <img src="{{ asset('assets/img/icons/x.png') }}" class="w-8" alt="Twitter">
                </a>
                <button onclick="navigator.clipboard.writeText('{{ request()->fullUrl() }}')" title="Salin Tautan">
                    <img src="{{ asset('assets/img/icons/link.png') }}" class="w-8" alt="Salin Tautan">
                </button>
            </div>

            @auth
            <div class="font-semibold text-sm">
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

        <div class="flex flex-col lg:flex-row w-full gap-10">
            <div class="lg:w-8/12">
                <img src="{{ asset('storage/' . $news->image) }}" alt="gambar" class="w-full max-h-96 rounded-xl object-cover mb-6">
                <div class="prose max-w-full prose-sm lg:prose-base prose-slate">
                    {!! $news->content !!}
                </div>
            </div>

            <div class="lg:w-4/12 flex flex-col gap-10">
                <div class="sticky top-24 z-40">
                    <p class="font-semibold mb-8 text-xl lg:text-2xl">Berita Terbaru Lainnya</p>
                    
                    <div class="gap-5 flex flex-col">
                        @foreach ($newests as $new)
                            <a href="{{ route('news.show', $new->slug) }}">
                                <div class="flex gap-3 bg-gray-50 shadow hover:border-gray-200 p-3 rounded-xl transition hover:shadow-md">
                                    <div class="flex gap-3 flex-col">
                                        <img src="{{ asset('storage/' . $new->image) }}" class="w-full h-full object-cover rounded-xl"
                                            style="object-fit: cover;">
                                        <h2 class=" font-semibold text-xl hover:underline transition ">{!! Str::words($new->title, 8, '...') !!}</h2>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <h3 class="text-xl font-semibold mt-10 mb-4">Komentar</h3>

        @auth
        <form method="POST" action="{{ route('comment.store', $news->id) }}" class="mb-6">
            @csrf
            <textarea name="content" rows="3" required class="w-full border p-3 rounded mb-3 text-sm focus:outline-none focus:ring focus:border-gray-400" placeholder="Tulis komentarmu di sini..."></textarea>
            <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white font-semibold text-sm px-4 py-2 rounded">
                Kirim Komentar
            </button>
        </form>
        @else
        <p><a href="{{ route('login') }}" class="text-gray-800 underline">Login</a> untuk berkomentar.</p>
        @endauth

        <div class="mt-4 mb-10">
            @if ($news->comments->isEmpty())
                 <div class="text-center text-gray-500 italic bg-gray-50 p-6 rounded-lg shadow-sm">
                    Belum ada komentar untuk berita ini. Jadilah yang pertama!
                </div>
            @else
                <div class="space-y-4">
                    @foreach ($news->comments->sortByDesc('created_at') as $comment)
                        <div class="flex gap-4 p-4 bg-gray-50 rounded-lg shadow-sm">
                            <div class="flex-shrink-0">
                                <img src="{{ asset('assets/img/profile.png') }}"
                                    alt="{{ $comment->user->name }}"
                                    class="w-10 h-10 rounded-full object-cover">
                            </div>

                            <div>
                                <div class="flex items-center gap-2">
                                    <p class="font-semibold text-gray-800">{{ $comment->user->name }}</p>
                                    <span class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-sm text-gray-700 mt-1">
                                    {{ $comment->content }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
