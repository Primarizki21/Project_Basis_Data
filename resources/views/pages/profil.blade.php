@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
  <div class="card p-6 flex gap-6 items-center">
    <div class="w-24 h-24 rounded-xl bg-gradient-to-br from-blue-100 to-teal-100 flex items-center justify-center text-2xl font-bold text-teal-700">
      {{ strtoupper(substr(Auth::user()->email ?? 'U', 0, 1)) }}
    </div>
    <div class="flex-1">
      <div class="font-bold text-lg">{{ Auth::user()->nama }}</div>
      <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
      <div class="mt-3 flex gap-3">
        <button onclick="document.getElementById('edit-panel').classList.toggle('hidden')" class="px-3 py-2 rounded-md border">Edit Profil</button>
        <a href="{{ route('riwayat.index') }}" class="px-3 py-2 rounded-md border text-teal-600">Lihat Riwayat</a>
      </div>
    </div>
  </div>

  <div id="edit-panel" class="card p-6 hidden">
    <form method="POST" action="{{ route('profil.update') }}" class="space-y-3">
      @csrf
      <div>
        <label class="text-sm font-semibold">Nama</label>
        <input name="nama" required value="{{ Auth::user()->nama }}" class="w-full mt-1 px-3 py-2 border rounded-md">
      </div>
      <div>
        <label class="text-sm font-semibold">No. HP (opsional)</label>
        <input name="nomor_telepon" value="{{ Auth::user()->nomor_telepon ?? '' }}" class="w-full mt-1 px-3 py-2 border rounded-md">
      </div>
      <div class="flex gap-3">
        <button class="bg-gradient-to-r from-blue-500 to-teal-500 text-white px-4 py-2 rounded-md">Simpan</button>
        <button type="button" onclick="document.getElementById('edit-panel').classList.add('hidden')" class="px-4 py-2 rounded-md border">Batal</button>
      </div>
    </form>
  </div>

  <div class="card p-6">
    <h3 class="font-bold mb-2">Tentang Akun</h3>
    <div class="text-sm text-gray-600">Halaman profil dummy. Tambah info (prodi, NIM) bila perlu.</div>
    <div class="mt-4 grid grid-cols-2 gap-4 text-sm">
      <div><div class="text-gray-500">Program Studi</div><div class="font-semibold">Teknologi Sains Data</div></div>
      <div><div class="text-gray-500">Angkatan</div><div class="font-semibold">2023</div></div>
      <div><div class="text-gray-500">NIM</div><div class="font-semibold">{{ Auth::user()->nim }}</div></div>
      <div><div class="text-gray-500">Status</div><div class="font-semibold">Mahasiswa</div></div>
    </div>
  </div>
</div>
@endsection
