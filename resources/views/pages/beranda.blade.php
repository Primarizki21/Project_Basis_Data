@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 lg:px-6 py-6">
  <!-- Welcome Header -->
  <div class="mb-8">
    <div class="bg-gradient-to-br from-[#6B21A8] via-[#7C3AED] to-[#0ea5f0] rounded-2xl shadow-lg border-none">
      <div class="p-8">
        <div class="text-white">
          <h3 class="font-bold text-2xl lg:text-3xl mb-2">Selamat Datang, {{ Auth::user()->nama ?? 'User' }}! 👋</h3>
          <p class="mb-0 opacity-80 text-lg">Berikut ringkasan pengaduan Anda hari ini</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Quick Stats -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
      <div class="flex items-center">
        <div class="w-14 h-14 bg-gradient-to-br from-[#6B21A8] to-[#7C3AED] rounded-xl flex items-center justify-center mr-4 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 text-white"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
        </div>
        <div>
          <small class="text-gray-500 block font-medium mb-1">Total Pengaduan</small>
          <h4 class="font-bold text-2xl text-[#6B21A8]">{{ $total ?? 0 }}</h4>
        </div>
      </div>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
      <div class="flex items-center">
        <div class="w-14 h-14 bg-gradient-to-br from-[#f59e0b] to-[#d97706] rounded-xl flex items-center justify-center mr-4 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 text-white"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        </div>
        <div>
          <small class="text-gray-500 block font-medium mb-1">Sedang Diproses</small>
          <h4 class="font-bold text-2xl text-[#f59e0b]">{{ $diproses ?? 0 }}</h4>
        </div>
      </div>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
      <div class="flex items-center">
        <div class="w-14 h-14 bg-gradient-to-br from-[#10b981] to-[#059669] rounded-xl flex items-center justify-center mr-4 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 text-white"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        </div>
        <div>
          <small class="text-gray-500 block font-medium mb-1">Selesai</small>
          <h4 class="font-bold text-2xl text-[#10b981]">{{ $selesai ?? 0 }}</h4>
        </div>
      </div>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
      <div class="flex items-center">
        <div class="w-14 h-14 bg-gradient-to-br from-[#ef4444] to-[#dc2626] rounded-xl flex items-center justify-center mr-4 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 text-white"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        </div>
        <div>
          <small class="text-gray-500 block font-medium mb-1">Ditolak</small>
          <h4 class="font-bold text-2xl text-[#ef4444]">{{ $ditolak ?? 0 }}</h4>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Pengaduan Terbaru -->
    <div class="lg:col-span-2">
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
          <div>
            <h5 class="font-bold text-lg text-gray-800">Pengaduan Terbaru</h5>
            <small class="text-gray-500" data_target="{{ $totalPengaduan }}">{{ $totalPengaduan }} pengaduan terakhir Anda</small>
          </div>
          <a href="{{ route('riwayat') }}" class="inline-flex items-center px-4 py-2 border border-[#7C3AED] text-[#7C3AED] text-sm font-semibold rounded-lg hover:bg-[#7C3AED] hover:text-white transition-all duration-300">
            Lihat Semua
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
          </a>
        </div>

        <div class="p-6">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($pengaduanTerbaru as $p)
              <div class="bg-white border border-gray-200 rounded-xl p-5 hover:border-[#7C3AED] hover:shadow-lg hover:-translate-y-1 transition-all duration-300 h-full flex flex-col">
                <div class="flex justify-between items-start mb-3">
                  <span class="inline-block px-2 py-1 bg-gray-100 text-gray-600 rounded-md text-xs font-mono">
                    #TKT-{{ str_pad($p->pengaduan_id, 3, '0', STR_PAD_LEFT) }}
                  </span>
                  <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-medium
                    @if($p->status_pengaduan == 'Diproses') bg-yellow-100 text-yellow-800
                    @elseif($p->status_pengaduan == 'Selesai') bg-green-100 text-green-800
                    @elseif($p->status_pengaduan == 'Ditolak') bg-red-100 text-red-800
                    @else bg-gray-100 text-gray-800 @endif">
                    {{ $p->status_pengaduan }}
                  </span>
                </div>
                <span class="inline-block self-start px-2 py-1 rounded text-white text-xs font-medium mb-3"
                  style="background-color: {{ $warnaKategori[$p->kategoriKomplain->jenis_komplain] ?? '#6c757d' }};">
                  {{ $p->kategoriKomplain->jenis_komplain ?? '-' }}
                </span>
                <p class="text-gray-600 text-sm mb-4 line-clamp-3 flex-1">
                  {{ $p->deskripsi_kejadian }}
                </p>
                <div class="text-gray-400 text-xs flex items-center mt-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 mr-1"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" /></svg>
                    {{ \Carbon\Carbon::parse($p->tanggal_kejadian)->translatedFormat('d M Y') }}
                </div>
              </div>
            @empty
              <div class="col-span-3">
                <div class="text-center py-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-400"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
                    </div>
                    <p class="text-gray-500 font-medium">Belum ada pengaduan terbaru.</p>
                </div>
              </div>
            @endforelse
          </div>
        </div>
      </div>
    </div>

    <!-- Tips & Info -->
    <div class="lg:col-span-1">
      <div class="rounded-2xl shadow-lg overflow-hidden h-full bg-gradient-to-br from-[#0ea5f0] to-[#0284c7] text-white p-6 relative group hover:-translate-y-1 transition-transform duration-300">
        <div class="flex items-center mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.383a14.406 14.406 0 01-3 0M14.25 18v-.192c0-.983.658-1.854 1.577-2.087a6.014 6.014 0 012.146 0c.92.233 1.577 1.104 1.577 2.087V18a2.25 2.25 0 002.25 2.25h.15a2.25 2.25 0 002.25-2.25V8.718a2.25 2.25 0 00-.75-1.744A11.03 11.03 0 0015 5.25 11.03 11.03 0 005.25 6.974a2.25 2.25 0 00-.75 1.744V18a2.25 2.25 0 002.25 2.25h.15A2.25 2.25 0 009 18v-2.146a6.014 6.014 0 012.277-4.908l.723-.547" /></svg>
            <h5 class="font-bold text-xl">Tips Pengaduan Efektif</h5>
        </div>
        <ul class="space-y-3 pl-2 text-white/90">
            <li class="flex items-start">
                <span class="bg-white/20 rounded-full w-5 h-5 flex items-center justify-center text-xs mr-3 mt-0.5 flex-shrink-0">1</span>
                Jelaskan masalah secara detail dan spesifik
            </li>
            <li class="flex items-start">
                <span class="bg-white/20 rounded-full w-5 h-5 flex items-center justify-center text-xs mr-3 mt-0.5 flex-shrink-0">2</span>
                Sertakan bukti foto jika memungkinkan
            </li>
            <li class="flex items-start">
                <span class="bg-white/20 rounded-full w-5 h-5 flex items-center justify-center text-xs mr-3 mt-0.5 flex-shrink-0">3</span>
                Cantumkan lokasi dan waktu kejadian
            </li>
        </ul>
      </div>
    </div>

    <!-- Quick Info -->
    <div class="lg:col-span-1">
      <div class="rounded-2xl shadow-lg overflow-hidden h-full bg-gradient-to-br from-[#6B21A8] to-[#7C3AED] text-white p-6 relative group hover:-translate-y-1 transition-transform duration-300">
        <div class="flex items-center mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" /></svg>
            <h5 class="font-bold text-xl">Informasi Penting</h5>
        </div>
        <div class="space-y-4 text-white/90">
            <p class="flex items-center bg-white/10 p-3 rounded-xl">
                <span class="text-xl mr-3">⏱️</span>
                <span>Pengaduan diproses maksimal <strong>3x24 jam</strong></span>
            </p>
            <p class="flex items-center bg-white/10 p-3 rounded-xl">
                <span class="text-xl mr-3">📧</span>
                <span>Notifikasi dikirim via email untuk setiap update</span>
            </p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
