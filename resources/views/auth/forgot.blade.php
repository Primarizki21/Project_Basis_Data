@extends('layouts.app')
@section('title', 'Lupa Password')

@section('content')
<div class="max-w-md mx-auto bg-white shadow-lg rounded-2xl p-8 mt-12">
  <h2 class="text-2xl font-semibold text-center mb-6">Reset Password</h2>

  <form action="{{ route('forgot') }}" method="POST">
    @csrf
    <label class="block text-sm mb-2">Masukkan Email Anda</label>
    <input type="email" name="email" class="w-full border border-gray-300 rounded px-3 py-2 mb-4 focus:ring focus:ring-blue-100" required>
    <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">Kirim Link Reset</button>
  </form>
</div>
@endsection