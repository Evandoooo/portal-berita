@extends('layouts.auth')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
  <div class="max-w-md w-full bg-white p-6 rounded-md">
    <div class="text-center mb-6">
      <a href="/" class="text-xl font-bold italic">BeritaKita<span class="font-normal">.com</span></a>
    </div>

    <form action="{{ route('register') }}" method="POST">
      @csrf
      <div class="mb-4">
        <label for="name">Nama</label>
        <input type="text" name="name" class="w-full border p-2" required>
      </div>
      <div class="mb-4">
        <label for="email">Email</label>
        <input type="email" name="email" class="w-full border p-2" required>
      </div>
      <div class="mb-2">
        <label for="password">Password</label>
        <input type="password" name="password" class="w-full border p-2" required>
        <p class="text-xs text-gray-600 mt-1">
          Kata sandi harus menyertakan setidaknya:<br>
          - 8 karakter, huruf besar dan kecil, 1 angka, 1 karakter khusus
        </p>
      </div>
      <div class="mb-4">
        <label for="password_confirmation">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="w-full border p-2" required>
      </div>

      <div class="mb-2">
        <label class="inline-flex items-start">
          <input type="checkbox" class="mt-1" required>
          <span class="ml-2 text-sm">
            Saya menyetujui Syarat & Ketentuan dan Pernyataan Privasi
          </span>
        </label>
      </div>

      <button type="submit" class="w-full bg-gray-700 text-white py-2 rounded">Daftar</button>

      <div class="mt-4 text-center text-sm">
        Sudah memiliki akun? <a href="{{ route('login') }}" class="font-bold">Masuk</a>
      </div>
    </form>
  </div>
</div>
@endsection
