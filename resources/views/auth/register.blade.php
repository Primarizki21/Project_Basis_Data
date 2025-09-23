@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto">
  <div class="card p-6 mt-6">
    <h2 class="text-2xl font-bold text-teal-700 mb-1 text-center">Daftar Akun VOIZ</h2>
    <p class="text-center text-sm text-gray-500 mb-4">Gunakan email institusi <strong>@ftmm.unair.ac.id</strong></p>

    <form method="POST" action="{{ route('register') }}" class="space-y-3">
      @csrf

      <div>
        <label class="text-sm font-semibold">NIM</label>
        <input name="nim" value="{{ old('nim') }}" required class="w-full mt-1 px-3 py-2 border rounded-md">
        @error('nim')<div class="text-rose-500 text-xs mt-1">{{ $message }}</div>@enderror
      </div>

      <div>
        <label class="text-sm font-semibold">Nama Lengkap</label>
        <input name="nama" value="{{ old('nama') }}" required class="w-full mt-1 px-3 py-2 border rounded-md">
        @error('nama')<div class="text-rose-500 text-xs mt-1">{{ $message }}</div>@enderror
      </div>

      <div>
        <label class="text-sm font-semibold">Email Institusi</label>
        <input name="email" value="{{ old('email') }}" required pattern=".+@ftmm\.unair\.ac\.id" class="w-full mt-1 px-3 py-2 border rounded-md">
        @error('email')<div class="text-rose-500 text-xs mt-1">{{ $message }}</div>@enderror
      </div>

      <div>
        <label class="text-sm font-semibold">Jenis Kelamin</label>
        <select name="jenis_kelamin" required class="w-full mt-1 px-3 py-2 border rounded-md">
          <option value="">-- Pilih --</option>
          <option value="Laki-laki" {{ old('jenis_kelamin')=='Laki-laki'?'selected':'' }}>Laki-laki</option>
          <option value="Perempuan" {{ old('jenis_kelamin')=='Perempuan'?'selected':'' }}>Perempuan</option>
          <option value="Lainnya" {{ old('jenis_kelamin')=='Lainnya'?'selected':'' }}>Lainnya</option>
        </select>
        @error('jenis_kelamin')<div class="text-rose-500 text-xs mt-1">{{ $message }}</div>@enderror
      </div>

      <div>
        <label class="text-sm font-semibold">Tempat Lahir</label>
        <input name="tempat_lahir" value="{{ old('tempat_lahir') }}" required class="w-full mt-1 px-3 py-2 border rounded-md">
        @error('tempat_lahir')<div class="text-rose-500 text-xs mt-1">{{ $message }}</div>@enderror
      </div>

      <div>
        <label class="text-sm font-semibold">Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required class="w-full mt-1 px-3 py-2 border rounded-md">
        @error('tanggal_lahir')<div class="text-rose-500 text-xs mt-1">{{ $message }}</div>@enderror
      </div>

      <div>
        <label class="text-sm font-semibold">Alamat</label>
        <textarea name="alamat" required class="w-full mt-1 px-3 py-2 border rounded-md">{{ old('alamat') }}</textarea>
        @error('alamat')<div class="text-rose-500 text-xs mt-1">{{ $message }}</div>@enderror
      </div>

      <div>
        <label class="text-sm font-semibold">Nomor Telepon</label>
        <input name="nomor_telepon" value="{{ old('nomor_telepon') }}" required class="w-full mt-1 px-3 py-2 border rounded-md">
        @error('nomor_telepon')<div class="text-rose-500 text-xs mt-1">{{ $message }}</div>@enderror
      </div>

      <div>
        <label class="text-sm font-semibold">Pekerjaan</label>
        <input name="pekerjaan" value="{{ old('pekerjaan') }}" required class="w-full mt-1 px-3 py-2 border rounded-md">
        @error('pekerjaan')<div class="text-rose-500 text-xs mt-1">{{ $message }}</div>@enderror
      </div>

      <div>
        <label class="text-sm font-semibold">Password</label>
        <input name="password" type="password" required minlength="6" class="w-full mt-1 px-3 py-2 border rounded-md">
        @error('password')<div class="text-rose-500 text-xs mt-1">{{ $message }}</div>@enderror
      </div>

      <div>
        <label class="text-sm font-semibold">Konfirmasi Password</label>
        <input name="password_confirmation" type="password" required minlength="6" class="w-full mt-1 px-3 py-2 border rounded-md">
        @error('password_confirmation')<div class="text-rose-500 text-xs mt-1">{{ $message }}</div>@enderror
      </div>

      <div class="flex items-center justify-between">
        <a href="{{ route('login.form') }}" class="text-sm text-gray-600">Kembali ke Login</a>
        <button type="submit" class="bg-gradient-to-r from-blue-500 to-teal-500 text-white px-4 py-2 rounded-md">Daftar</button>
      </div>
    </form>
  </div>
</div>
@endsection
