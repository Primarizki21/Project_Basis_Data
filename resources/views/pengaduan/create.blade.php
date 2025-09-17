@extends('layout')

@section('content')
<h2>Buat Pengaduan</h2>

<form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Kategori Kekerasan</label>
    <input type="text" name="kategori_kekerasan" required>

    <label>Deskripsi Kejadian</label>
    <textarea name="deskripsi_kejadian" required></textarea>

    <label>Tanggal Kejadian</label>
    <input type="date" name="tanggal_kejadian" required>

    <label>Status Pelapor</label>
    <select name="status_pelapor" required>
        <option value="Korban">Korban</option>
        <option value="Keluarga">Keluarga</option>
        <option value="Teman">Teman</option>
        <option value="Saksi">Saksi</option>
    </select>

    <label>Upload Bukti (bisa lebih dari 1)</label>
    <input type="file" name="bukti[]" multiple>

    <button type="submit">Kirim</button>
</form>
@endsection
