@extends('layout')

@section('content')
<h2>Detail Pengaduan</h2>

<p>Kategori: {{ $pengaduan->kategori_kekerasan }}</p>
<p>Deskripsi: {{ $pengaduan->deskripsi_kejadian }}</p>
<p>Status: {{ $pengaduan->status_pengaduan }}</p>

<h3>Bukti</h3>
<ul>
    @foreach($pengaduan->bukti as $bukti)
        <li><a href="{{ asset('storage/'.$bukti->file_path) }}" target="_blank">Lihat Bukti</a></li>
    @endforeach
</ul>

<h3>Tindak Lanjut</h3>
@if($pengaduan->tindakLanjut)
    <p>{{ $pengaduan->tindakLanjut->jenis_tindak_lanjut }} - {{ $pengaduan->tindakLanjut->deskripsi }}</p>
@else
    <p>Belum ada tindak lanjut.</p>
@endif

@role('admin')
<h3>Tambah/Update Tindak Lanjut</h3>
<form action="{{ route('pengaduan.tindakLanjut', $pengaduan->pengaduan_id) }}" method="POST">
    @csrf
    <label>Jenis Tindak Lanjut</label>
    <input type="text" name="jenis_tindak_lanjut" required>

    <label>Deskripsi</label>
    <textarea name="deskripsi" required></textarea>

    <button type="submit">Simpan</button>
</form>
@endrole
@endsection
