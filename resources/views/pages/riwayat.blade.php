@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 lg:px-6 py-6">
  <!-- Page Header -->
  <div class="mb-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-2">Riwayat Pengaduan</h2>
    <p class="text-gray-500">Daftar semua pengaduan yang pernah Anda ajukan</p>
  </div>

  <!-- Filter Section -->
  <div class="mb-8">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
      <form action="{{ route('riwayat') }}" method="GET">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          <div>
            <label class="block font-semibold text-gray-700 mb-2 text-sm">Status</label>
            <div class="relative">
                <select class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent appearance-none bg-white" name="status">
                  <option value="" {{ request('status') == '' ? 'selected' : '' }}>Semua Status</option>
                  <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                  <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                  <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                </div>
            </div>
          </div>
          {{-- Filter : Kategori --}}
          <div>
            <label class="block font-semibold text-gray-700 mb-2 text-sm">Kategori</label>
            <div class="relative">
                <select class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent appearance-none bg-white" name="kategori_komplain_id">
                  <option value="">Semua Kategori</option>
                  <option value="1" {{ request('kategori_komplain_id') == '1' ? 'selected' : '' }}>Akademik</option>
                  <option value="2" {{ request('kategori_komplain_id') == '2' ? 'selected' : '' }}>Fasilitas</option>
                  <option value="3" {{ request('kategori_komplain_id') == '3' ? 'selected' : '' }}>Kekerasan</option>
                  <option value="4" {{ request('kategori_komplain_id') == '4' ? 'selected' : '' }}>Kemahasiswaan</option>
                  <option value="5" {{ request('kategori_komplain_id') == '5' ? 'selected' : '' }}>Lainnya</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                </div>
            </div>
          </div>

          {{-- Filter: Tanggal --}}
          <div>
              <label class="block font-semibold text-gray-700 mb-2 text-sm">Tanggal</label>
              <input type="date" name="tanggal" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent" value="{{ request('tanggal') }}">
          </div>

          {{-- Filter : Search --}}
          <div>
              <label class="block font-semibold text-gray-700 mb-2 text-sm">Cari Tiket / Deskripsi</label>
              <div class="relative">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
                  </div>
                  <input type="text"
                      name="search"
                      class="w-full border border-gray-300 rounded-xl pl-10 pr-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent"
                      placeholder="Cari..."
                      value="{{ request('search') }}">
              </div>
          </div>
        </div>

        <div class="mt-6 flex gap-3">
            <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-[#6B21A8] to-[#7C3AED] text-white font-semibold rounded-xl hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" /></svg>
                Filter
            </button>
            <a href="{{ route('riwayat') }}" class="inline-flex items-center px-5 py-2.5 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" /></svg>
                Reset
            </a>
        </div>
      </form>
    </div>
  </div>

  <!-- Table -->
  <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-left border-collapse">
        <thead class="bg-gray-50/50 border-b border-gray-100">
          <tr>
            <th class="px-6 py-4 font-semibold text-gray-700 text-sm">No. Tiket</th>
            <th class="px-6 py-4 font-semibold text-gray-700 text-sm">Kategori</th>
            <th class="px-6 py-4 font-semibold text-gray-700 text-sm w-1/3">Deskripsi</th>
            <th class="px-6 py-4 font-semibold text-gray-700 text-sm">Tanggal</th>
            <th class="px-6 py-4 font-semibold text-gray-700 text-sm">Status</th>
            <th class="px-6 py-4 font-semibold text-gray-700 text-sm text-center">Aksi</th>
          </tr>
        </thead>

        <tbody class="divide-y divide-gray-100">
          @if($pengaduan->isEmpty())
            <tr>
              <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                <div class="flex flex-col items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 mb-2 text-gray-300"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" /></svg>
                    <span>Belum ada pengaduan yang diajukan.</span>
                </div>
              </td>
            </tr>
          @else
            @foreach($pengaduan as $item)
              <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4">
                  <span class="inline-block px-2.5 py-1 bg-gray-100 text-gray-700 rounded-md text-xs font-mono font-bold">
                    #TKT-{{ str_pad($item->pengaduan_id, 3, '0', STR_PAD_LEFT) }}
                  </span>
                </td>

                <td class="px-6 py-4">
                  <span class="inline-block px-2.5 py-1 rounded text-white text-xs font-medium"
                        style="background-color: {{ $warnaKategori[$item->kategoriKomplain->jenis_komplain] ?? '#6c757d' }};">
                    {{ $item->kategoriKomplain->jenis_komplain ?? '-' }}
                  </span>
                </td>

                <td class="px-6 py-4">
                  <div class="max-w-xs truncate text-gray-600 text-sm">
                    {{ $item->deskripsi_kejadian }}
                  </div>
                </td>

                <td class="px-6 py-4">
                  <div class="text-sm text-gray-500">
                    {{ $item->tanggal_kejadian ? \Carbon\Carbon::parse($item->tanggal_kejadian)->format('d M Y') : '-' }}
                  </div>
                </td>

                <td class="px-6 py-4">
                  @if($item->status_pengaduan == 'Menunggu')
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Belum Diproses</span>
                  @elseif($item->status_pengaduan == 'Diproses')
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Sedang Diproses</span>
                  @elseif($item->status_pengaduan == 'Selesai')
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Selesai</span>
                  @else
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">{{ $item->status_pengaduan }}</span>
                  @endif
                </td>

                <td class="px-6 py-4 text-center">
                  <div class="flex justify-center space-x-2">
                    <a href="{{ route('pengaduan.show', $item->pengaduan_id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    </a>
                    <a href="{{ route('pengaduan.edit', $item->pengaduan_id) }}" class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition-colors" title="Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                    </a>
                  </div>
                </td>
              </tr>
            @endforeach
          @endif
        </tbody>
      </table>
    </div>

    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
      <p class="text-sm text-gray-500">
        Menampilkan <span class="font-bold">{{ $pengaduan->count() }}</span> pengaduan
      </p>
    </div>
  </div>
</div>
@endsection
