@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto card p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Pengaduan</h1>
    
    <form action="{{ route('pengaduan.update', $pengaduan->pengaduan_id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Field yang bisa diedit oleh semua --}}
        <div class="mb-4">
            <label for="tanggal_kejadian" class="block font-semibold">Tanggal Kejadian</label>
            <input type="date" name="tanggal_kejadian" value="{{ old('tanggal_kejadian', \Carbon\Carbon::parse($pengaduan->tanggal_kejadian)->format('Y-m-d')) }}" class="w-full mt-1 px-3 py-2 border rounded-md" required>
        </div>

        <div class="mb-4">
            <label for="deskripsi_kejadian" class="block font-semibold">Deskripsi Kejadian</label>
            <textarea name="deskripsi_kejadian" rows="5" class="w-full mt-1 px-3 py-2 border rounded-md" required>{{ old('deskripsi_kejadian', $pengaduan->deskripsi_kejadian) }}</textarea>
        </div>
        
        <div class="mb-4">
            <label for="kategori_komplain_id" class="block font-semibold">Kategori Komplain</label>
            <select id="kategori_komplain_id" name="kategori_komplain_id" class="w-full mt-1 px-3 py-2 border rounded-md" required>
                <option value="">-- Pilih Kategori --</option>
                
                {{-- Loop semua data kategori yang dikirim dari controller --}}
                @foreach($kategori_komplain as $kategori)
                    <option value="{{ $kategori->kategori_komplain_id }}" 
                        {{-- Logika untuk memilih opsi yang sesuai dengan data saat ini --}}
                        {{ old('kategori_komplain_id', $pengaduan->kategori_komplain_id) == $kategori->kategori_komplain_id ? 'selected' : '' }}>
                        
                        {{ $kategori->jenis_komplain }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Tampilkan field ini HANYA JIKA yang login adalah ADMIN --}}
        @auth('admin')
        <div class="mb-6 bg-gray-100 p-4 rounded-md">
            <label for="status_pengaduan" class="block font-semibold text-gray-700">Status Pengaduan (Admin Only)</label>
            <select id="status_pengaduan" name="status_pengaduan" class="w-full mt-1 px-3 py-2 border rounded-md">
                <option value="Menunggu" @if($pengaduan->status_pengaduan == 'Menunggu') selected @endif>Menunggu</option>
                <option value="Diproses" @if($pengaduan->status_pengaduan == 'Diproses') selected @endif>Diproses</option>
                <option value="Selesai" @if($pengaduan->status_pengaduan == 'Selesai') selected @endif>Selesai</option>
            </select>
        </div>
        @endauth

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Simpan Perubahan</button>
    </form>
</div>
@endsection