@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
  <div class="card p-6">
    <h2 class="text-xl font-bold mb-2">Buat Pengaduan Baru</h2>
    <p class="text-sm text-gray-500 mb-4">Silakan isi detail pengaduan Anda.</p>

    {{-- FORMUTAMA --}}
    <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
      @csrf

      {{-- Kategori --}}
      <div>
        <label class="text-sm font-semibold">Kategori</label>
        <select name="kategori_komplain_id" required class="w-full mt-1 px-3 py-2 border rounded-md">
          <option value="">-- Pilih Kategori --</option>
          @foreach($kategori as $k)
            <option value="{{ $k->kategori_komplain_id }}">{{ $k->jenis_komplain }}</option>
          @endforeach
        </select>
      </div>

      {{-- Deskripsi --}}
      <div>
        <label class="text-sm font-semibold">Deskripsi Kejadian</label>
        <textarea name="deskripsi_kejadian" rows="5" required class="w-full mt-1 px-3 py-2 border rounded-md"></textarea>
      </div>

      {{-- Tanggal --}}
      <div>
        <label class="text-sm font-semibold">Tanggal Kejadian</label>
        <input type="date" name="tanggal_kejadian" class="w-full mt-1 px-3 py-2 border rounded-md">
      </div>

      {{-- Status Pelapor --}}
      <div>
        <label class="text-sm font-semibold">Status Pelapor</label>
        <select name="status_pelapor" required class="w-full mt-1 px-3 py-2 border rounded-md">
          <option value="Korban">Korban</option>
          <option value="Keluarga">Keluarga</option>
          <option value="Teman">Teman</option>
          <option value="Saksi">Saksi</option>
        </select>
      </div>

      {{-- Upload Bukti --}}
      <div>
        <label class="text-sm font-semibold">Upload Bukti (opsional)</label>
        <input type="file" name="bukti[]" multiple class="w-full mt-1 px-3 py-2 border rounded-md">
        <p class="text-xs text-gray-500">Bisa upload lebih dari satu file (gambar/pdf).</p>
      </div>

      {{-- Tombol --}}
      <div class="flex gap-3">
        <button type="submit" class="bg-gradient-to-r from-blue-500 to-teal-500 text-white px-4 py-2 rounded-md">
          Kirim Pengaduan
        </button>
        <a href="{{ route('beranda') }}" class="px-4 py-2 rounded-md border">Batal</a>
      </div>
    </form>
  </div>
</div>
@endsection
