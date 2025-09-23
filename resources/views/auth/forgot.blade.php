@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto">
  <div class="card p-6 mt-6">
    <h2 class="text-2xl font-bold text-teal-700 mb-1 text-center">Lupa Password</h2>
    <p class="text-center text-sm text-gray-500 mb-4">Masukkan email institusi untuk menerima tautan reset (simulasi).</p>

    <form method="POST" action="{{ route('forgot') }}" class="space-y-3">
      @csrf
      <div>
        <label class="text-sm font-semibold">Email</label>
        <input name="email" value="{{ old('email') }}" required class="w-full mt-1 px-3 py-2 border rounded-md">
        @if($errors->has('email'))<div class="text-rose-500 text-xs mt-1">{{ $errors->first('email') }}</div>@endif
      </div>

      <div class="flex items-center justify-between">
        <a href="{{ route('login.form') }}" class="text-sm text-gray-600">Kembali ke Login</a>
        <button type="submit" class="bg-gradient-to-r from-blue-500 to-teal-500 text-white px-4 py-2 rounded-md">Kirim Link Reset</button>
      </div>
    </form>

    <div class="mt-3 text-xs text-gray-500">Nota: ini simulasi — sistem tidak benar-benar mengirim email.</div>
  </div>
</div>
@endsection