<!-- Navbar -->
<div class="sticky top-0 z-50 bg-white shadow-sm">
    <!-- Top Bar: Logo + Search + User -->
    <div class="flex justify-between items-center py-4 px-4 lg:px-14">
        <!-- Logo -->
        <a href="{{ route('landing') }}">
            <div class="flex items-center gap-2">
                <p class="text-xl font-bold italic">BeritaKita<span class="font-normal">.com</span></p>
            </div>
        </a>

        <form action="{{ route('news.search') }}" method="GET" class="relative w-full max-w-sm mx-auto flex-grow hidden lg:flex">
            <input type="text" name="q" placeholder="Cari berita..."
                class="rounded-full px-4 py-2 pl-8 text-sm font-normal
                       bg-gray-100 border border-transparent
                       focus:outline-none focus:bg-white focus:shadow-sm focus:ring-0 w-full"
                autocomplete="off" />
            <span class="absolute inset-y-0 left-2 flex items-center text-slate-400">
                <img src="{{ asset('assets/img/search.png') }}" alt="search" class="w-4">
            </span>
        </form>

        <!-- Auth (Desktop) -->
        <div class="hidden lg:flex items-center gap-4">
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
                    class="bg-gray-600 hover:bg-black px-6 py-2 rounded-full text-white font-semibold text-sm">
                    Masuk
                </a>
            @endauth
        </div>

        <!-- Toggle Button (Mobile) -->
        <button class="lg:hidden focus:outline-none" id="menu-toggle">
            <img src="{{ asset('assets/img/menu-icon.png') }}" alt="Menu" class="w-10 h-6">
        </button>
    </div>


    <!-- Menu Kategori (Desktop) -->

    <div class="hidden lg:flex px-4 lg:px-14 pb-3 overflow-x-auto">
        <ul class="flex justify-center flex-grow gap-6 font-semibold text-sm text-gray-600 whitespace-nowrap">
            <li>
                <a href="{{ route('landing') }}"
                    class="{{ request()->is('/') ? 'border-b-2 border-black pb-2 text-black' : '' }} hover:text-black transition-colors duration-200">
                    Home
                </a>
            </li>
            @foreach ($categories as $category)
                <li>
                    <a href="{{ route('news.category', $category->slug) }}"
                        class="{{ request()->routeIs('news.category') && request()->route('category') == $category->slug ? 'border-b-2 border-black pb-1 text-black' : '' }} hover:text-black transition-colors duration-200 whitespace-nowrap">
                        {{ $category->name }}
                    </a>
                </li>
            @endforeach
        </ul>
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
            class="block text-center bg-gray-600 px-4 py-2 rounded-full text-white font-semibold text-sm">
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
                <a href="{{ route('news.category', $category->slug) }}" class="hover:text-gray-600">
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
