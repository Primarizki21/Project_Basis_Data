@extends('layouts.app')

@section('content')
<!-- Hero Section with Background Image -->
<section class="relative overflow-hidden hero-section min-h-[80vh] flex items-center">
  <div class="hero-bg absolute top-0 left-0 w-full h-full z-0 bg-cover bg-center animate-[subtle-zoom_20s_ease-in-out_infinite_alternate]" style="background-image: url('https://images.unsplash.com/photo-1562774053-701939374585?q=80&w=2000');">
    <div class="absolute inset-0 bg-gradient-to-br from-primary/95 via-[#7C3AED]/90 to-secondary/85"></div>
  </div>

  <div class="container mx-auto px-4 lg:px-8 relative z-10 py-12 lg:py-20">
    <div class="grid lg:grid-cols-2 gap-12 items-center">
      <div class="text-white">
        <h1 class="text-4xl lg:text-6xl font-bold mb-6 animate-[fadeInUp_0.8s_ease-out]">
          Selamat Datang di <span class="text-[#fbbf24]">VOIZ FTMM</span>
        </h1>
        <p class="text-xl lg:text-2xl mb-6 font-light opacity-90 animate-[fadeInUp_0.8s_ease-out_0.2s_backwards]">
          Sistem Pengaduan Online Fakultas Teknologi Maju dan Multidisiplin Universitas Airlangga
        </p>
        <p class="text-lg mb-8 opacity-80 animate-[fadeInUp_0.8s_ease-out_0.4s_backwards]">
          Sampaikan aspirasi, keluhan, dan saran Anda dengan mudah dan transparan. Kami siap mendengarkan dan menindaklanjuti setiap pengaduan Anda.
        </p>
        <div class="flex flex-wrap gap-4 animate-[fadeInUp_0.8s_ease-out_0.6s_backwards]">
          @guest
            <a href="{{ route('login') }}" class="btn-hero-primary group">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2 transition-transform group-hover:translate-x-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
              </svg>
              Masuk
            </a>
            <a href="{{ route('register') }}" class="btn-hero-outline">
              Daftar Sekarang
            </a>
          @else
            <a href="{{ route('pengaduan.create') }}" class="btn-hero-warning group">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2 transition-transform group-hover:rotate-90">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
              </svg>
              Buat Pengaduan
            </a>
          @endguest
        </div>
      </div>
      <div class="hidden lg:block">
        <div class="animate-[float_3s_ease-in-out_infinite]">
          <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-[30px] p-10 text-center text-white shadow-2xl">
            <div class="inline-flex items-center justify-center p-4 rounded-full bg-white/20 mb-6 animate-[pulse_2s_ease-in-out_infinite]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 110-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 01-1.44-4.282m3.102.069a18.03 18.03 0 01-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 018.835 2.535M10.34 6.66a23.847 23.847 0 018.835-2.535m0 0A23.74 23.74 0 0018.795 3m.38 1.125a23.91 23.91 0 011.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 001.014-5.395m0-3.46c.495.439.72 1.063.72 1.73 0 .666-.225 1.29-.72 1.73m0-3.46a24.347 24.347 0 010 3.46" />
                </svg>
            </div>
            <h3 class="text-3xl font-bold mb-2">Suara Anda Penting</h3>
            <p class="opacity-75 text-lg">Bersama membangun kampus yang lebih baik</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Wave Bottom -->
  <div class="absolute -bottom-1 left-0 w-full overflow-hidden leading-[0]">
    <svg class="relative block w-[calc(100%+1.3px)] h-[80px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,64L48,69.3C96,75,192,85,288,80C384,75,480,53,576,48C672,43,768,53,864,64C960,75,1056,85,1152,80C1248,75,1344,53,1392,42.7L1440,32L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z" class="fill-gray-50"></path>
    </svg>
  </div>
</section>

<!-- Jenis Pengaduan Section -->
<section id="jenis-pengaduan" class="py-20 bg-gray-50">
  <div class="container mx-auto px-4 lg:px-8">
    <div class="text-center mb-16 fade-in-up">
      <h2 class="text-3xl font-bold mb-3 text-gray-800">Jenis Pengaduan</h2>
      <p class="text-gray-500">Pilih kategori pengaduan sesuai dengan keluhan Anda</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        {{-- Kategori Cards --}}
        @php
            $kategoris = [
                ['id' => 1, 'name' => 'Akademik', 'desc' => 'Masalah perkuliahan, kurikulum, nilai', 'icon' => 'book', 'gradient' => 'from-[#6B21A8] to-[#7C3AED]'],
                ['id' => 2, 'name' => 'Fasilitas', 'desc' => 'Sarana & prasarana kampus', 'icon' => 'building', 'gradient' => 'from-[#0ea5f0] to-[#0284c7]'],
                ['id' => 3, 'name' => 'Kekerasan', 'desc' => 'Bullying, pelecehan, kekerasan', 'icon' => 'shield', 'gradient' => 'from-[#ef4444] to-[#dc2626]'],
                ['id' => 4, 'name' => 'Kemahasiswaan', 'desc' => 'Pelayanan kemahasiswaan', 'icon' => 'users', 'gradient' => 'from-[#f59e0b] to-[#d97706]'],
                ['id' => 5, 'name' => 'Lainnya', 'desc' => 'Komplain di luar kategori utama', 'icon' => 'dots', 'gradient' => 'from-[#8b5cf6] to-[#7c3aed]'],
            ];
        @endphp

        @foreach($kategoris as $cat)
          <div class="fade-in-up" style="animation-delay: {{ $loop->index * 100 }}ms">
            @guest
            <a href="{{ route('login') }}" class="block h-full group">
            @else
            <a href="{{ route('pengaduan.create') }}?kategori={{ $cat['id'] }}" class="block h-full group">
            @endguest
              <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-2 h-full relative overflow-hidden">
                <div class="absolute -top-[50%] -left-[50%] w-[200%] h-[200%] bg-[radial-gradient(circle,rgba(107,33,168,0.05)_0%,transparent_70%)] scale-0 group-hover:scale-100 transition-transform duration-500"></div>
                <div class="text-center relative z-10">
                  <div class="w-20 h-20 mx-auto mb-6 rounded-2xl bg-gradient-to-br {{ $cat['gradient'] }} flex items-center justify-center text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                    @if($cat['icon'] == 'book')
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" /></svg>
                    @elseif($cat['icon'] == 'building')
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5M12 6.75h1.5m-3 3h1.5m1.5 0h1.5m-3 3h1.5m1.5 0h1.5M9 10.5v5.25m3-5.25v5.25m3-5.25v5.25" /></svg>
                    @elseif($cat['icon'] == 'shield')
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016A11.959 11.959 0 0112 2.964z" /></svg>
                    @elseif($cat['icon'] == 'users')
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>
                    @elseif($cat['icon'] == 'dots')
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" /></svg>
                    @endif
                  </div>
                  <h5 class="text-xl font-bold mb-2 text-gray-800">{{ $cat['name'] }}</h5>
                  <p class="text-gray-500 text-sm">{{ $cat['desc'] }}</p>
                </div>
              </div>
            </a>
          </div>
        @endforeach
    </div>
  </div>
</section>

<!-- Alur Pengaduan Section with Wave -->
<section id="alur" class="py-20 relative bg-gradient-to-br from-[#6B21A8] via-[#7C3AED] to-[#0ea5f0]">
  <!-- Wave Top -->
  <div class="absolute -top-[1px] left-0 w-full overflow-hidden leading-[0] rotate-180">
    <svg class="relative block w-[calc(100%+1.3px)] h-[80px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,64L48,69.3C96,75,192,85,288,80C384,75,480,53,576,48C672,43,768,53,864,64C960,75,1056,85,1152,80C1248,75,1344,53,1392,42.7L1440,32L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z" class="fill-gray-50"></path>
    </svg>
  </div>

  <div class="container mx-auto px-4 lg:px-8 py-10">
    <div class="text-center mb-16 fade-in-up">
      <h2 class="text-3xl font-bold text-white mb-2">Alur Pengaduan</h2>
      <p class="text-white/80">Proses pengaduan yang mudah dan transparan</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
      @php
          $steps = [
              ['step' => 1, 'title' => 'Isi Formulir', 'desc' => 'Login dan lengkapi formulir pengaduan dengan detail', 'icon' => 'pencil'],
              ['step' => 2, 'title' => 'Kirim Pengaduan', 'desc' => 'Mendapat nomor tiket untuk tracking', 'icon' => 'send'],
              ['step' => 3, 'title' => 'Diproses Admin', 'desc' => 'Tim kami menindaklanjuti pengaduan', 'icon' => 'gear'],
              ['step' => 4, 'title' => 'Selesai', 'desc' => 'Notifikasi hasil tindak lanjut', 'icon' => 'check'],
          ];
      @endphp
      @foreach($steps as $step)
        <div class="fade-in-up" style="animation-delay: {{ $loop->index * 100 }}ms">
            <div class="text-center">
              <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mx-auto mb-6 text-primary shadow-[0_10px_30px_rgba(107,33,168,0.3)] transition-transform duration-300 hover:scale-110 hover:rotate-6">
                @if($step['icon'] == 'pencil')
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                @elseif($step['icon'] == 'send')
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" /></svg>
                @elseif($step['icon'] == 'gear')
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10"><path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 110-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 01-1.44-4.282m3.102.069a18.03 18.03 0 01-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 018.835 2.535M10.34 6.66a23.847 23.847 0 018.835-2.535m0 0A23.74 23.74 0 0018.795 3m.38 1.125a23.91 23.91 0 011.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 001.014-5.395m0-3.46c.495.439.72 1.063.72 1.73 0 .666-.225 1.29-.72 1.73m0-3.46a24.347 24.347 0 010 3.46" /></svg>
                @elseif($step['icon'] == 'check')
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                @endif
              </div>
              <div class="bg-white rounded-2xl p-6 shadow-lg">
                <div class="inline-block px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-bold mb-3">Langkah {{ $step['step'] }}</div>
                <h5 class="text-lg font-bold mb-2 text-gray-800">{{ $step['title'] }}</h5>
                <p class="text-gray-500 text-sm mb-0">{{ $step['desc'] }}</p>
              </div>
            </div>
        </div>
      @endforeach
    </div>
  </div>

  <!-- Wave Bottom -->
  <div class="absolute -bottom-[1px] left-0 w-full overflow-hidden leading-[0]">
    <svg class="relative block w-[calc(100%+1.3px)] h-[80px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,64L48,69.3C96,75,192,85,288,80C384,75,480,53,576,48C672,43,768,53,864,64C960,75,1056,85,1152,80C1248,75,1344,53,1392,42.7L1440,32L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z" class="fill-white"></path>
    </svg>
  </div>
</section>

<!-- Pengaduan Anonim Publik -->
<section id="pengaduan-anonim" class="py-20 bg-white">
  <div class="container mx-auto px-4 lg:px-8">
    <div class="text-center mb-16 fade-in-up">
      <div class="mb-6">
        <div class="w-20 h-20 mx-auto bg-gradient-to-br from-[#6B21A8] to-[#7C3AED] rounded-2xl flex items-center justify-center shadow-lg">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-white">
                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
            </svg>
        </div>
      </div>
      <h2 class="text-3xl font-bold mb-3 text-gray-800">Pengaduan Anonim Publik</h2>
      <p class="text-gray-500">Transparansi pengaduan dari masyarakat kampus</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
      @forelse($pengaduanAnonim as $index => $anonim)
          <div class="fade-in-up flex" style="animation-delay: {{ $index * 100 }}ms">
              <div class="bg-white border-none rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-2 w-full flex flex-col p-6">
                  <div class="flex justify-between items-start mb-4">
                      <div>
                          <span class="inline-block px-3 py-1 rounded-full text-white text-xs font-bold mb-2" style="background-color: {{ $warnaKategori[$anonim->kategoriKomplain->jenis_komplain] ?? '#6c757d' }};">
                              {{ $anonim->kategoriKomplain->jenis_komplain }}
                          </span>
                          <div class="text-gray-500 text-xs flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 mr-1"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" /></svg>
                            {{ $anonim->created_at->format('d M Y') }}
                          </div>
                      </div>
                      <div class="text-right">
                          @if($anonim->status_pengaduan == 'Selesai')
                              <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3 mr-1"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" /></svg>
                                Selesai
                              </span>
                          @elseif($anonim->status_pengaduan == 'Diproses')
                              <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3 mr-1"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-11.25a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z" clip-rule="evenodd" /></svg>
                                Diproses
                              </span>
                          @else
                              <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3 mr-1"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-13a.75.75 0 00-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 000-1.5h-3.25V5z" clip-rule="evenodd" /></svg>
                                Menunggu
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="mb-4">
                      <h6 class="font-bold mb-2 text-gray-800">Pengaduan:</h6>
                      <p class="text-gray-600 text-sm leading-relaxed">{{ Str::limit($anonim->deskripsi_kejadian, 150) }}</p>
                  </div>

                  @if($anonim->tindakLanjutTerbaru)
                      <div class="mt-auto pt-4 border-t border-gray-100">
                          <div class="p-4 rounded-xl bg-gray-50 border-l-4 border-[#7C3AED]">
                              <div class="flex justify-between items-center mb-2">
                                  <h6 class="font-bold text-sm text-[#6B21A8] flex items-center">
                                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" /></svg>
                                      {{ $anonim->tindakLanjutTerbaru->jenis_tindak_lanjut ?? 'Tanggapan Admin' }}
                                  </h6>
                                  @if($anonim->tindakLanjutTerbaru->handler)
                                  <span class="text-gray-500 text-xs flex items-center">
                                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 mr-1"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                                      Oleh: <strong>{{ $anonim->tindakLanjutTerbaru->handler->nama }}</strong>
                                  </span>
                                  @endif
                              </div>
                              <p class="text-gray-600 text-sm mb-2">
                                  {{ $anonim->tindakLanjutTerbaru->deskripsi }}
                              </p>
                              <small class="text-gray-400 block text-right italic text-xs">
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 inline mr-1"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                  {{ $anonim->tindakLanjutTerbaru->created_at->translatedFormat('d M Y, H:i') }}
                              </small>
                          </div>
                      </div>
                  @endif
              </div>
          </div>
      @empty
          <div class="col-span-1 lg:col-span-2">
              <div class="text-center py-12">
                  <div class="w-20 h-20 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-gray-400"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" /></svg>
                  </div>
                  <h4 class="text-xl font-bold text-gray-800">Belum Ada Pengaduan</h4>
                  <p class="text-gray-500">Saat ini belum ada pengaduan anonim yang ditampilkan.</p>
              </div>
          </div>
      @endforelse
    </div>
    
    <div class="text-center mt-12">
      <a href="{{ route('pengaduan.createAnonim') }}" class="btn-hero-primary inline-flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
        Buat Pengaduan Anonim
      </a>
    </div>
  </div>
</section>

<!-- Kontak Section with Background Image -->
<section id="kontak" class="py-20 relative min-h-[60vh] flex items-center overflow-hidden">
  <div class="absolute inset-0 bg-cover bg-center z-0" style="background-image: url('https://images.unsplash.com/photo-1541339907198-e08756dedf3f?q=80&w=2000');"></div>
  <div class="absolute inset-0 bg-gradient-to-br from-[#6B21A8]/90 to-[#0ea5f0]/90 z-10"></div>
  
  <div class="container mx-auto px-4 lg:px-8 relative z-20">
    <div class="text-center mb-16 text-white fade-in-up">
      <h2 class="text-3xl font-bold mb-2">Hubungi Kami</h2>
      <p class="opacity-75">Ada pertanyaan atau butuh bantuan? Tim kami siap membantu</p>
    </div>

    <div class="grid lg:grid-cols-2 gap-12 items-center">
      <div class="fade-in-up">
        <div class="space-y-4">
          <div class="flex items-start p-4 rounded-xl bg-white/15 backdrop-blur-md border border-white/10">
            <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center mr-4 text-[#6B21A8] flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" /></svg>
            </div>
            <div class="text-white">
              <h6 class="font-bold text-lg">Email</h6>
              <p class="opacity-80">ftmm@unair.ac.id</p>
            </div>
          </div>

          <div class="flex items-start p-4 rounded-xl bg-white/15 backdrop-blur-md border border-white/10">
            <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center mr-4 text-[#0ea5f0] flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" /></svg>
            </div>
            <div class="text-white">
              <h6 class="font-bold text-lg">Telepon</h6>
              <p class="opacity-80">(031) 5914042</p>
            </div>
          </div>

          <div class="flex items-start p-4 rounded-xl bg-white/15 backdrop-blur-md border border-white/10">
            <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center mr-4 text-[#f59e0b] flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
            </div>
            <div class="text-white">
              <h6 class="font-bold text-lg">Alamat</h6>
              <p class="opacity-80">Kampus C UNAIR, Mulyorejo, Surabaya</p>
            </div>
          </div>
        </div>
      </div>

      <div class="fade-in-up delay-200">
        <div class="bg-white rounded-3xl p-8 shadow-2xl">
          <h5 class="font-bold text-2xl mb-6 text-gray-800">Jam Operasional</h5>
          <div class="space-y-4">
            <div class="flex justify-between items-center border-b border-gray-100 pb-3">
              <span class="text-gray-600">Senin - Jumat</span>
              <span class="font-bold text-primary">08:00 - 16:00 WIB</span>
            </div>
            <div class="flex justify-between items-center border-b border-gray-100 pb-3">
              <span class="text-gray-600">Sabtu</span>
              <span class="font-bold text-primary">08:00 - 12:00 WIB</span>
            </div>
            <div class="flex justify-between items-center">
              <span class="text-gray-600">Minggu</span>
              <span class="text-red-500 font-bold bg-red-50 px-3 py-1 rounded-full text-sm">Tutup</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="py-6 text-center bg-gradient-to-r from-[#6B21A8] to-[#7C3AED]">
  <div class="container mx-auto px-4">
    <p class="text-white/90 text-sm font-medium">&copy; 2025 VOIZ FTMM - Fakultas Teknologi Maju dan Multidisiplin UNAIR</p>
  </div>
</footer>

<style>
/* Custom Utility Classes handled by Tailwind */
.btn-hero-primary {
  @apply inline-flex items-center px-8 py-3 bg-white text-primary font-bold rounded-xl shadow-lg hover:-translate-y-1 hover:shadow-xl transition-all duration-300;
}
.btn-hero-outline {
  @apply inline-flex items-center px-8 py-3 border-2 border-white/30 text-white font-bold rounded-xl hover:bg-white/10 hover:border-white transition-all duration-300;
}
.btn-hero-warning {
  @apply inline-flex items-center px-8 py-3 bg-[#fbbf24] text-gray-900 font-bold rounded-xl shadow-lg hover:-translate-y-1 hover:shadow-xl hover:bg-[#f59e0b] transition-all duration-300;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.remove('opacity-0', 'translate-y-8');
        entry.target.classList.add('opacity-100', 'translate-y-0');
      }
    });
  }, observerOptions);

  document.querySelectorAll('.fade-in-up').forEach(el => {
    el.classList.add('opacity-0', 'translate-y-8', 'transition-all', 'duration-700', 'ease-out');
    observer.observe(el);
  });
});
</script>
@endsection
