@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto">
  <div class="card p-6 mt-6">
    <h2 class="text-2xl font-bold text-teal-700 mb-1 text-center">Masuk VOIZ</h2>
    <p class="text-center text-sm text-gray-500 mb-4">Gunakan email institusi <strong>@ftmm.unair.ac.id</strong></p>

    <form method="POST" action="{{ route('login') }}" class="space-y-3">
      @csrf
      <div>
        <label class="text-sm font-semibold">Email</label>
        <input type="email" name="email" required pattern=".+@ftmm\.unair\.ac\.id" value="{{ old('email') }}" class="w-full mt-1 px-3 py-2 border rounded-md">
        @if($errors->has('email'))<div class="text-rose-500 text-xs mt-1">{{ $errors->first('email') }}</div>@endif
      </div>

      <div>
        <label class="text-sm font-semibold">Password</label>
        <input type="password" name="password" required class="w-full mt-1 px-3 py-2 border rounded-md">
        @if($errors->has('password'))<div class="text-rose-500 text-xs mt-1">{{ $errors->first('password') }}</div>@endif
      </div>

      <div class="flex items-center justify-between">
        <button type="submit" class="bg-gradient-to-r from-blue-500 to-teal-500 text-white px-4 py-2 rounded-md">Login</button>
        <a href="{{ route('password.request') }}" class="text-sm text-gray-500">Lupa password?</a>
      </div>
    </form>

    <div class="mt-4 text-center text-sm text-gray-600">Belum punya akun? <a href="{{ route('register.form') }}" class="text-teal-600 font-semibold">Daftar</a></div>
  </div>
</div>
@endsection