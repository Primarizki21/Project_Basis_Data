@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
  <div class="flex gap-4">
    <input id="search" placeholder="Cari pengaduan..." class="flex-1 px-3 py-2 border rounded-md" />
    <a href="{{ route('pengaduan.form') }}" class="bg-gradient-to-r from-blue-500 to-teal-500 text-white px-4 py-2 rounded-md">Buat Pengaduan</a>
  </div>

  <div class="card p-4">
    <div class="mb-3 text-sm text-gray-500">Daftar pengaduan Anda.</div>
    <div class="overflow-x-auto">
      <table class="w-full text-sm">
        <thead class="text-left text-gray-500">
          <tr>
            <th class="px-3 py-2">No</th>
            <th class="px-3 py-2">Judul/Deskripsi</th>
            <th class="px-3 py-2">Kategori</th>
            <th class="px-3 py-2">Status</th>
            <th class="px-3 py-2">Tanggal Kejadian</th>
          </tr>
        </thead>
        <tbody id="table-body">
          {{-- Loop data dari variabel $pengaduan yang dikirim controller --}}
          @forelse($pengaduan as $p)
            <tr class="border-t">
              <td class="px-3 py-2">{{ $loop->iteration }}</td>
              {{-- Karena tidak ada kolom judul, kita tampilkan potongan deskripsi --}}
              <td class="px-3 py-2">{{ Str::limit($p->deskripsi_kejadian, 50) }}</td>
              {{-- Akses nama kategori melalui relasi `kategoriKomplain` --}}
              <td class="px-3 py-2">{{ $p->kategoriKomplain->jenis_kekerasan ?? 'Tidak ada kategori' }}</td>
              <td class="px-3 py-2">
                <span class="px-2 py-1 rounded-md text-sm 
                  @if($p->status_pengaduan == 'Selesai') bg-green-100 text-green-800
                  @elseif($p->status_pengaduan == 'Diproses') bg-blue-100 text-blue-800
                  @else bg-yellow-100 text-yellow-800 @endif">
                  {{ $p->status_pengaduan }}
                </span>
              </td>
              {{-- Format tanggal agar lebih mudah dibaca --}}
              <td class="px-3 py-2">{{ \Carbon\Carbon::parse($p->tanggal_kejadian)->format('d M Y') }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="px-3 py-6 text-center text-gray-500">Belum ada pengaduan yang Anda buat.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
  const search = document.getElementById('search');
  search?.addEventListener('input', (e) => {
    const q = e.target.value.toLowerCase();
    document.querySelectorAll('#table-body tr').forEach(row => {
      row.style.display = row.innerText.toLowerCase().includes(q) ? '' : 'none';
    });
  });
</script>
@endsection