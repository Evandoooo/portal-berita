<footer class="bg-[#1a1a1a] text-white py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="border-b border-white !important pb-6 mb-6">
            <h1 class="text-xl font-bold italic text-white">BeritaKita<span class="font-normal text-gray-300">.com</span></h1>
        </div>

        <div class="flex flex-col lg:flex-row justify-between gap-8">
            <div>
                <h2 class="text-sm font-bold mb-7">TELUSURI</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3 text-sm text-gray-300">
                    @foreach ($categories as $category)
                        <a href="{{ route('news.category', $category->slug) }}" class="hover:text-white">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div>
                <h2 class="text-sm font-bold mb-4">TAUTAN</h2>
                <div class="flex space-x-4 text-white text-xl">
                    <a href="#" class="hover:text-gray-300" aria-label="Website">
                        <img src="{{ asset('assets/img/icons/browser-dark.png') }}" class="w-8" alt="Browser">
                    </a>
                    <a href="#" class="hover:text-gray-300" aria-label="Facebook">
                        <img src="{{ asset('assets/img/icons/facebook-dark.png') }}" class="w-8" alt="Facebook">
                    </a>
                    <a href="#" class="hover:text-gray-300" aria-label="Instagram">
                        <img src="{{ asset('assets/img/icons/instagram-dark.png') }}" class="w-8" alt="Instagram">
                    </a>
                    <a href="mailto:info@beritakita.com" class="hover:text-gray-300" aria-label="Email">
                        <img src="{{ asset('assets/img/icons/email-dark.png') }}" class="w-8" alt="Email">
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
