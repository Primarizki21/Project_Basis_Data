@extends('layouts.app')

@section('content')
<div class="space-y-6">

  <!-- Welcome (blue → tosca gradient) -->
  <div class="rounded-xl p-6 text-white" style="background: linear-gradient(90deg,#0ea5f0,#06b6d4); box-shadow: 0 12px 40px rgba(6,95,70,0.06);">
    <div class="flex justify-between items-center">
      <div>
        Halo, <span class="capitalize">{{ explode(' ', Auth::user()->name)[0] ?? 'Pengguna' }}</span> 👋

        <p class="text-sm mt-1">Selamat datang di VOIZ — platform pengaduan FTMM.</p>
      </div>
      <div class="text-right">
        <div class="text-sm opacity-80">Tanggal</div>
        <div class="font-bold">{{ date('d F Y') }}</div>
      </div>
    </div>
  </div>

  <!-- Stats & Pie -->
  <div class="grid md:grid-cols-3 gap-6">
    <div class="md:col-span-2 card p-6">
      <h2 class="font-bold mb-2">Ringkasan Pengaduan</h2>
      <p class="text-sm text-gray-500 mb-4">Statistik singkat.</p>

      <div class="grid grid-cols-3 gap-4 text-center">
        <div>
          <div class="text-gray-500">Total</div>
          <div class="text-3xl font-extrabold text-blue-600 counter" data-target="128">0</div>
        </div>
        <div>
          <div class="text-gray-500">Baru (7 hari)</div>
          <div class="text-3xl font-extrabold text-teal-600 counter" data-target="12">0</div>
        </div>
        <div>
          <div class="text-gray-500">Selesai</div>
          <div class="text-3xl font-extrabold text-green-600 counter" data-target="92">0</div>
        </div>
      </div>
    </div>

    <div class="card p-6">
      <h2 class="font-bold mb-2">Statistik Kategori</h2>
      <canvas id="kategoriChart" class="w-full h-56"></canvas>
    </div>
  </div>

  <!-- Jenis Pengaduan -->
  <div class="card p-6">
    <h3 class="font-bold mb-4">Jenis Pengaduan</h3>
    <div class="grid md:grid-cols-4 gap-4">
      @foreach ([
        ['t'=>'Akademik','d'=>'Nilai, plagiarisme, materi kuliah','c'=>'from-blue-50 to-blue-100','col'=>'text-blue-700'],
        ['t'=>'Kemahasiswaan','d'=>'Organisasi, beasiswa','c'=>'from-teal-50 to-teal-100','col'=>'text-teal-700'],
        ['t'=>'Sarana & Prasarana','d'=>'Kerusakan fasilitas','c'=>'from-green-50 to-green-100','col'=>'text-green-700'],
        ['t'=>'Kekerasan & Keamanan','d'=>'Kasus sensitif & keselamatan','c'=>'from-rose-50 to-rose-100','col'=>'text-rose-700'],
      ] as $j)
      <div class="relative group">
        <div class="p-4 rounded-xl bg-gradient-to-br {{ $j['c'] }} card pop cursor-pointer transition transform hover:scale-105">
          <div class="font-bold {{ $j['col'] }}">{{ $j['t'] }}</div>
          <div class="text-sm text-gray-600 mt-2">{{ $j['d'] }}</div>
        </div>

        <!-- hover popup -->
        <div class="absolute inset-0 hidden group-hover:flex items-center justify-center p-4">
          <div class="bg-white rounded-xl shadow-lg p-4 w-full text-sm">
            <div class="font-semibold mb-2">{{ $j['t'] }} — Contoh Kasus</div>
            <div class="text-gray-600">
              @if($j['t']=='Akademik')
                - Nilai tidak sesuai; - Materi tidak tersedia; - Plagiarisme
              @elseif($j['t']=='Kemahasiswaan')
                - Sengketa organisasi; - Permintaan bantuan beasiswa
              @elseif($j['t']=='Sarana & Prasarana')
                - Kerusakan alat; - Permintaan ruang
              @else
                - Kekerasan fisik/psikis; - Pengancaman; Prosedur prioritas.
              @endif
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>

  <!-- Alur -->
  <div class="card p-6">
    <h3 class="font-bold mb-4">Alur Pengaduan (detail)</h3>
    <div class="flex items-center justify-between">
      @foreach ([
        ['n'=>'1','title'=>'Buat Laporan','desc'=>'Isi form + lampirkan bukti'],
        ['n'=>'2','title'=>'Verifikasi','desc'=>'Admin cek kelengkapan & validitas'],
        ['n'=>'3','title'=>'Penugasan','desc'=>'Diteruskan ke unit terkait'],
        ['n'=>'4','title'=>'Tindak Lanjut','desc'=>'Unit menindaklanjuti & update'],
        ['n'=>'5','title'=>'Selesai','desc'=>'Pengadu menerima notifikasi & menutup tiket'],
      ] as $step)
      <div class="flex-1 text-center px-2">
        <div class="mx-auto w-10 h-10 flex items-center justify-center rounded-full bg-gradient-to-br from-blue-500 to-teal-500 text-white font-bold">{{ $step['n'] }}</div>
        <div class="font-semibold mt-2">{{ $step['title'] }}</div>
        <div class="text-sm text-gray-500 mt-1">{{ $step['desc'] }}</div>
      </div>
      @endforeach
    </div>
    <div class="mt-4 h-1 bg-gradient-to-r from-blue-200 to-teal-200 rounded-full"></div>
  </div>

  <!-- Aksi Cepat -->
  <div class="rounded-xl p-6" style="background: linear-gradient(90deg,#0ea5f0,#06b6d4);">
    <div class="max-w-3xl mx-auto text-center">
      <h3 class="text-white text-lg font-bold mb-3">Aksi Cepat</h3>
      <div class="flex flex-col md:flex-row gap-3 justify-center">
        <a href="{{ route('pengaduan.form') }}" class="bg-white text-teal-600 font-bold py-2 px-4 rounded-md">Buat Pengaduan Baru</a>
        <a href="{{ route('riwayat.index') }}" class="bg-white text-teal-600 font-bold py-2 px-4 rounded-md">Lihat Riwayat</a>
        <a href="{{ route('kontak') }}" class="bg-white text-red-600 font-bold py-2 px-4 rounded-md">Kontak Darurat</a>
      </div>
    </div>
  </div>

</div>

<!-- chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // counters
  document.querySelectorAll('.counter').forEach(el=>{
    const target = +el.dataset.target;
    let start = 0;
    const step = Math.max(1, Math.floor(target / 120));
    const tick = () => {
      start += step;
      if (start >= target) { el.innerText = target; }
      else { el.innerText = start; requestAnimationFrame(tick); }
    };
    tick();
  });

  // doughnut chart
  const ctx = document.getElementById('kategoriChart').getContext('2d');
  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Akademik','Kemahasiswaan','Sarana','Kekerasan','Lainnya'],
      datasets: [{
        data: [40,25,15,12,8],
        backgroundColor: ['#3b82f6','#06b6d4','#10b981','#ef4444','#f59e0b'],
        borderWidth: 0
      }]
    },
    options: { responsive:true, animation:{duration:1400} , plugins:{legend:{position:'bottom'}} }
  });
</script>
@endsection