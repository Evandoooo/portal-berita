<!-- Navbar -->
<div class="sticky top-0 z-50 flex justify-between py-5 px-4 lg:px-14 bg-white shadow-sm">
    <div class="flex items-center justify-between w-full">
        <!-- Logo -->
        <a href="{{ route('landing') }}">
            <div class="flex items-center gap-2">
                <p class="text-xl font-bold italic">BeritaKita<span class="font-normal">.com</span></p>
            </div>
        </a>

        <!-- Toggle Button (Mobile) -->
        <button class="lg:hidden text-primary text-2xl focus:outline-none" id="menu-toggle">
            ☰
        </button>

        <!-- Menu Navigasi (Desktop) -->
        <div id="desktop-menu" class="hidden lg:flex lg:items-center lg:gap-10 ml-10">
            <ul class="flex items-center gap-6 font-medium text-base">
                <li>
                    <a href="{{ route('landing') }}" class="{{ request()->is('/') ? 'text-primary' : '' }} hover:text-gray-600">
                        Beranda
                    </a>
                </li>
                @php
                    $categories = \App\Models\Category::all();
                @endphp
                @foreach ($categories as $category)
                    <li>
                        <a href="{{ route('news.category', $category->slug) }}" class="hover:text-primary">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Search & Auth (Desktop) -->
    <div class="hidden lg:flex items-center gap-4">
        <form action="{{ route('news.search') }}" method="GET" class="relative w-full">
            <input type="text" name="q" placeholder="Cari berita..."
                class="border border-slate-300 rounded-full px-4 py-2 pl-8 text-sm font-normal focus:outline-none focus:ring-primary focus:border-primary w-full"
                autocomplete="off" />
            <span class="absolute inset-y-0 left-3 flex items-center text-slate-400">
                <img src="{{ asset('assets/img/search.png') }}" alt="search" class="w-4">
            </span>
        </form>

        <!-- Auth Dropdown -->
        @auth
            <div class="relative group">
                <button class="flex items-center gap-2 text-sm text-gray-700 font-medium focus:outline-none">
                    <span>Halo, {{ Auth::user()->name }}</span>
                    <svg class="w-4 h-4 transform group-hover:rotate-180 transition" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl border border-gray-200 z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition duration-200">
                    <div class="px-4 py-3 border-b border-gray-200">
                        <p class="text-sm font-semibold">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                    </div>
                    <ul class="py-2">
                        <li>
                            <a href="{{ route('user.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Berita yang Disimpan</a>

                        </li>
                    </ul>
                    <div class="px-4 py-2 border-t border-gray-200">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left text-sm text-red-600 hover:text-red-800 font-semibold">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <a href="{{ route('login') }}"
                class="bg-primary px-6 py-2 rounded-full text-white font-semibold text-sm">
                Masuk
            </a>
        @endauth
    </div>
</div>

<!-- Mobile Menu -->
<div id="menu" class="hidden lg:hidden px-4 py-4 space-y-4">
    <!-- Search Box (Mobile) -->
    <form action="{{ route('news.search') }}" method="GET" class="relative w-full">
        <input type="text" name="q" placeholder="Cari berita..."
            class="border border-slate-300 rounded-full px-4 py-2 pl-8 text-sm font-normal focus:outline-none focus:ring-primary focus:border-primary w-full"
            autocomplete="off" />
        <span class="absolute inset-y-0 left-3 flex items-center text-slate-400">
            <img src="{{ asset('assets/img/search.png') }}" alt="search" class="w-4">
        </span>
    </form>

    @auth
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-sm font-semibold">{{ Auth::user()->name }}</p>
            <p class="text-xs text-gray-500 mb-2">{{ Auth::user()->email }}</p>

            <a href="{{ route('user.profile') }}" class="block text-sm text-blue-600 hover:underline mb-2">Berita yang Disimpan</a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-semibold">Logout</button>
            </form>
        </div>
    @else
        <a href="{{ route('login') }}"
            class="block text-center bg-primary px-4 py-2 rounded-full text-white font-semibold text-sm">
            Masuk
        </a>
    @endauth

    <ul class="bg-white rounded-lg shadow p-4 flex flex-col gap-2 text-sm text-gray-700">
        <li>
            <a href="{{ route('landing') }}" class="{{ request()->is('/') ? 'text-primary' : '' }} hover:text-primary">
                Beranda
            </a>
        </li>
        @foreach ($categories as $category)
            <li>
                <a href="{{ route('news.category', $category->slug) }}" class="hover:text-primary">
                    {{ $category->name }}
                </a>
            </li>
        @endforeach
    </ul>
</div>

<!-- Toggle Script -->
<script>
    document.getElementById('menu-toggle').addEventListener('click', function () {
        const menu = document.getElementById('menu');
        menu.classList.toggle('hidden');
    });
</script>
