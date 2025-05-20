@extends('layouts.auth')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
  <div class="max-w-md w-full bg-white p-6 rounded-md">
    <div class="text-center mb-6">
      <a href="/" class="text-xl font-bold italic">BeritaKita<span class="font-normal">.com</span></a>
      <p class="text-sm mt-2">Masuk ke Akun Berita Anda</p>
    </div>

    <form action="{{ route('login') }}" method="POST">
      @csrf
      <div class="mb-4">
        <label for="email">Email</label>
        <input type="email" name="email" class="w-full border p-2" required>
      </div>
      <div class="mb-4">
        <label for="password">Password</label>
        <input type="password" name="password" class="w-full border p-2" required>
      </div>

      <div class="text-sm mb-4">
        <a href="#" class="text-gray-600 underline block">Saya lupa email saya</a>
        <a href="#" class="text-gray-600 underline block">Bantuan lainnya untuk masuk</a>
      </div>

      <button type="submit" class="w-full bg-gray-700 text-white py-2 rounded">Lanjutkan</button>

      <div class="mt-4 text-center text-sm">
        Belum memiliki akun? <a href="{{ route('register') }}" class="font-bold">Daftar</a>
      </div>
    </form>
  </div>
</div>
@endsection
