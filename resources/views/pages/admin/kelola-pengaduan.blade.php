@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 lg:px-6 py-6 animate-[fadeIn_0.6s_ease-out]">
  <!-- Page Header -->
  <div class="mb-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-2">Kelola Pengaduan</h2>
    <p class="text-gray-500">Manajemen dan tindak lanjut semua pengaduan</p>
  </div>

  <!-- Filter & Search Bar -->
  <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
      <form action="{{ route('admin.kelola-pengaduan') }}" method="GET">
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 items-end">
              <div class="lg:col-span-1">
                  <label class="block font-semibold text-gray-700 mb-2 text-sm">Cari Pengaduan</label>
                  <div class="relative">
                      <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
                      </div>
                      <input type="text" name="search" class="w-full border border-gray-300 rounded-xl pl-10 pr-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent" placeholder="No. tiket atau deskripsi..." value="{{ request('search') }}">
                  </div>
              </div>

              <div>
                  <label class="block font-semibold text-gray-700 mb-2 text-sm">Status</label>
                  <div class="relative">
                      <select name="status" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent appearance-none bg-white">
                          <option value="" {{ request('status') == '' ? 'selected' : '' }}>Semua Status</option>
                          <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Belum Diproses</option>
                          <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                          <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                      </select>
                      <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                      </div>
                  </div>
              </div>

              <div>
                  <label class="block font-semibold text-gray-700 mb-2 text-sm">Kategori</label>
                  <div class="relative">
                      <select name="kategori_komplain_id" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent appearance-none bg-white">
                          <option value="" {{ request('kategori_komplain_id') == '' ? 'selected' : '' }}>Semua Kategori</option>
                          @foreach($kategoriKomplains as $kategori)
                              <option value="{{ $kategori->kategori_komplain_id }}" {{ request('kategori_komplain_id') == $kategori->kategori_komplain_id ? 'selected' : '' }}>
                                  {{ $kategori->jenis_komplain }}
                              </option>
                          @endforeach
                      </select>
                      <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                      </div>
                  </div>
              </div>

              <div>
                  <label class="block font-semibold text-gray-700 mb-2 text-sm">Tanggal</label>
                  <input type="date" name="tanggal" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent" value="{{ request('tanggal') }}">
              </div>

              <div class="flex gap-2">
                  <button type="submit" class="flex-1 inline-flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-[#6B21A8] to-[#7C3AED] text-white font-semibold rounded-xl hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" /></svg>
                      Filter
                  </button>
                  <a href="{{ route('admin.kelola-pengaduan') }}" class="p-2.5 border border-gray-300 text-gray-500 rounded-xl hover:bg-gray-50 transition-colors" title="Reset Filter">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" /></svg>
                  </a>
              </div>
          </div>
      </form>
  </div>

  <!-- Quick Stats -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-2xl p-5 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 cursor-pointer">
        <div class="flex items-center justify-between">
            <div>
                <small class="text-gray-500 block font-medium mb-1">Total Hari Ini</small>
                <h4 class="font-bold text-2xl text-[#6B21A8]">{{ $totalHariIni }}</h4>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-[#6B21A8] opacity-30"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" /></svg>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-5 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 cursor-pointer">
        <div class="flex items-center justify-between">
            <div>
                <small class="text-gray-500 block font-medium mb-1">Belum Diproses</small>
                <h4 class="font-bold text-2xl text-[#ef4444]">{{ $belumDiproses }}</h4>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-[#ef4444] opacity-30"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-5 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 cursor-pointer">
        <div class="flex items-center justify-between">
            <div>
                <small class="text-gray-500 block font-medium mb-1">Sedang Diproses</small>
                <h4 class="font-bold text-2xl text-[#f59e0b]">{{ $sedangDiproses }}</h4>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-[#f59e0b] opacity-30"><path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 110-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 01-1.44-4.282m3.102.069a18.03 18.03 0 01-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 018.835 2.535M10.34 6.66a23.847 23.847 0 018.835-2.535m0 0A23.74 23.74 0 0018.795 3m.38 1.125a23.91 23.91 0 011.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 001.014-5.395m0-3.46c.495.439.72 1.063.72 1.73 0 .666-.225 1.29-.72 1.73m0-3.46a24.347 24.347 0 010 3.46" /></svg>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-5 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 cursor-pointer">
        <div class="flex items-center justify-between">
            <div>
                <small class="text-gray-500 block font-medium mb-1">Selesai Minggu Ini</small>
                <h4 class="font-bold text-2xl text-[#10b981]">{{ $selesaiMingguIni }}</h4>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-[#10b981] opacity-30"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        </div>
    </div>
  </div>

  <!-- Table Pengaduan -->
  <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
      <div>
        <h5 class="font-bold text-lg text-gray-800">Daftar Pengaduan</h5>
        <small class="text-gray-500">{{ $pengaduans->total() }} total pengaduan ditemukan</small>
      </div>
      <button class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded-lg hover:bg-green-700 transition-colors shadow-md">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
        Export Excel
      </button>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50/50 border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4 font-semibold text-gray-700 text-sm">No. Tiket</th>
                    <th class="px-6 py-4 font-semibold text-gray-700 text-sm">Pelapor</th>
                    <th class="px-6 py-4 font-semibold text-gray-700 text-sm">Kategori</th>
                    <th class="px-6 py-4 font-semibold text-gray-700 text-sm w-1/3">Deskripsi</th>
                    <th class="px-6 py-4 font-semibold text-gray-700 text-sm">Tanggal</th>
                    <th class="px-6 py-4 font-semibold text-gray-700 text-sm">Status</th>
                    <th class="px-6 py-4 font-semibold text-gray-700 text-sm text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($pengaduans as $pengaduan)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <span class="font-mono font-bold text-gray-700 text-sm">#TKT-{{ $pengaduan->pengaduan_id }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <div>
                            @if($pengaduan->pelapor)
                                <div class="font-semibold text-gray-800 text-sm">{{ $pengaduan->pelapor->nama }}</div>
                                <small class="text-gray-500 text-xs">{{ $pengaduan->pelapor->email }}</small>
                            @else
                                <div class="font-semibold text-gray-800 text-sm">Anonim</div>
                                <small class="text-gray-500 text-xs">Tidak terdaftar</small>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-block px-2.5 py-1 rounded text-white text-xs font-medium" style="background-color: {{ $warnaKategori[$pengaduan->kategoriKomplain->jenis_komplain] ?? '#6c757d' }};">
                            {{ $pengaduan->kategoriKomplain->jenis_komplain }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="max-w-xs truncate text-gray-600 text-sm">
                            {{ $pengaduan->deskripsi_kejadian }}
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-600">{{ $pengaduan->created_at->format('d M Y') }}</div>
                        <div class="text-xs text-gray-400">{{ $pengaduan->created_at->format('H:i') }}</div>
                    </td>
                    <td class="px-6 py-4">
                        @if($pengaduan->status_pengaduan == 'Selesai')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Selesai</span>
                        @elseif($pengaduan->status_pengaduan == 'Diproses')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Sedang Diproses</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Belum Diproses</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('admin.pengaduan.edit', $pengaduan->pengaduan_id) }}" class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition-colors" title="Proses">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                            </a>
                            <form action="{{ route('admin.pengaduan.destroy', $pengaduan->pengaduan_id) }}" method="POST" class="inline-block" onsubmit="return confirm('Anda yakin ingin menghapus pengaduan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mb-3 text-gray-300"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" /></svg>
                            <span class="font-medium text-lg">Tidak ada data pengaduan.</span>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="p-6 border-t border-gray-100 bg-gray-50/50 flex flex-col md:flex-row justify-between items-center gap-4">
        <small class="text-gray-500">
            Menampilkan {{ $pengaduans->firstItem() }} - {{ $pengaduans->lastItem() }} dari {{ $pengaduans->total() }} pengaduan
        </small>
        <div>
            {{ $pengaduans->links() }}
        </div>
    </div>
  </div>
</div>
@endsection
