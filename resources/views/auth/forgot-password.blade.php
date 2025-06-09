@extends('layouts.auth')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
  <div class="max-w-md w-full bg-white p-6 rounded-md shadow-md">
    <div class="text-center mb-6">
      <a href="/" class="text-2xl font-bold italic text-gray-800">BeritaKita<span class="font-normal">.com</span></a>
      <p class="text-sm mt-2 text-gray-600">Lupa Password Anda?</p>
    </div>

    @if (session('status'))
      <div class="mb-4 text-green-600 bg-green-100 p-2 rounded">
        {{ session('status') }}
      </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
      @csrf

      <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}"
               required autofocus
               class="w-full mt-1 p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror">
        @error('email')
          <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
        Kirim Link Reset Password
      </button>
    </form>

    <p class="mt-4 text-center text-sm text-gray-600">
      <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">Kembali ke Login</a>
    </p>
  </div>
</div>
@endsection
