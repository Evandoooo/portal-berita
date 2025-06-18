@extends('layouts.auth')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
  <div class="max-w-md w-full bg-white p-6 rounded-md shadow-md">
    <div class="text-center mb-6">
      <a href="/" class="text-2xl font-bold italic text-gray-800">BeritaKita<span class="font-normal">.com</span></a>
      <p class="text-sm mt-2 text-gray-600">Masuk ke Akun Berita Anda</p>
    </div>

    @if(session('error'))
      <div class="mb-4 bg-red-100 text-red-700 px-4 py-2 rounded">
        {{ session('error') }}
      </div>
    @endif

    <form action="{{ route('login') }}" method="POST" novalidate>
      @csrf

      {{-- Email --}}
      <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" 
               class="w-full mt-1 p-2 border rounded focus:outline-none focus:ring-2 focus:ring-gray-500 @error('email') border-red-500 @enderror" 
               required autofocus>
        @error('email')
          <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-4">
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" id="password" name="password" 
               class="w-full mt-1 p-2 border rounded focus:outline-none focus:ring-2 focus:ring-gray-500 @error('password') border-red-500 @enderror" 
               required>
        @error('password')
          <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="text-right text-sm mb-4">
        <a href="{{ route('password.request') }}" class="hover:underline">Lupa password?</a>
      </div>

      <button type="submit" class="w-full bg-gray-600 text-white py-2 rounded hover:bg-gray-700 transition">
        Lanjutkan
      </button>

      <p class="mt-4 text-center text-sm text-gray-600">
      <a href="{{ url()->previous() }}" class="text-gray-600 font-semibold hover:underline">Kembali</a>
      </p>

      <p class="mt-4 text-center text-sm text-gray-600">
        Belum memiliki akun? 
        <a href="{{ route('register') }}" class="text-gray-800 font-semibold hover:underline">Daftar sekarang</a>
      </p>
    </form>
  </div>
</div>
@endsection
