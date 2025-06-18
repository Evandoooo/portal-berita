@extends('layouts.auth')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
  <div class="max-w-md w-full bg-white p-6 rounded-md shadow-md">
    
    <div class="text-center mb-6">
      <a href="/" class="text-2xl font-bold italic text-gray-800">BeritaKita<span class="font-normal">.com</span></a>
      <p class="text-sm mt-2 text-gray-600">Daftar untuk bergabung bersama kami</p>
    </div>

    @if(session('status'))
      <div class="mb-4 text-green-600 bg-green-100 p-2 rounded">
        {{ session('status') }}
      </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
      @csrf

      <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required
               class="w-full mt-1 p-2 border rounded focus:outline-none focus:ring-2 focus:ring-gray-600 @error('name') border-red-500 @enderror">
        @error('name')
          <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required
               class="w-full mt-1 p-2 border rounded focus:outline-none focus:ring-2 focus:ring-gray-600 @error('email') border-red-500 @enderror">
        @error('email')
          <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-4">
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" id="password" name="password" required
               class="w-full mt-1 p-2 border rounded focus:outline-none focus:ring-2 focus:ring-gray-600 @error('password') border-red-500 @enderror">
        @error('password')
          <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
        <p class="text-sm text-gray-600 mt-2">
          Kata sandi harus menyertakan setidaknya:<br>
          - 8 karakter, huruf besar dan kecil, 1 angka, 1 karakter khusus
        </p>
      </div>

      <div class="mb-4">
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required
               class="w-full mt-1 p-2 border rounded focus:outline-none focus:ring-2 focus:ring-gray-600">
      </div>

      <div class="mb-4">
        <label class="inline-flex items-start">
          <input type="checkbox" class="mt-1" required>
          <span class="ml-2 text-sm text-gray-600 ">
            Saya menyetujui Syarat & Ketentuan dan Pernyataan Privasi
          </span>
        </label>
      </div>

      <button type="submit" class="w-full bg-gray-600 text-white py-2 rounded hover:bg-gray-700 transition">
        Daftar
      </button>

      <p class="mt-4 text-center text-sm text-gray-600">
      <a href="{{ url()->previous() }}" class="text-gray-600 font-semibold hover:underline">Kembali</a>
      </p>
      
      <div class="mt-4 text-center text-sm text-gray-600">
        Sudah memiliki akun? <a href="{{ route('login') }}" class="text-gray-800 font-semibold hover:underline">Masuk sekarang</a>
      </div>
    </form>
  </div>
</div>
@endsection
