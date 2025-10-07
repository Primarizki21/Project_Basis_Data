@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <!-- Welcome Header -->
  <div class="row mb-4">
    <div class="col-12">
      <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #6B21A8 0%, #7C3AED 50%, #0ea5f0 100%); border-radius: 15px;">
        <div class="card-body p-4">
          <div class="text-white">
            <h3 class="fw-bold mb-2">Selamat Datang, {{ Auth::user()->nama ?? 'User' }}! 👋</h3>
            <p class="mb-0 opacity-75">Berikut ringkasan pengaduan Anda hari ini</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Quick Stats -->
  <div class="row g-4 mb-4">
    <div class="col-md-3">
      <div class="card border-0 shadow-sm hover-lift-card">
        <div class="card-body p-4">
          <div class="d-flex align-items-center">
            <div class="icon-box me-3" style="width: 55px; height: 55px; background: linear-gradient(135deg, #6B21A8, #7C3AED); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
              <i class="bi bi-file-earmark-text text-white" style="font-size: 1.5rem;"></i>
            </div>
            <div>
              <small class="text-muted d-block">Total Pengaduan</small>
              <h4 class="fw-bold mb-0" style="color: #6B21A8;">{{ $total ?? 0 }}</h4>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card border-0 shadow-sm hover-lift-card">
        <div class="card-body p-4">
          <div class="d-flex align-items-center">
            <div class="icon-box me-3" style="width: 55px; height: 55px; background: linear-gradient(135deg, #f59e0b, #d97706); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
              <i class="bi bi-hourglass-split text-white" style="font-size: 1.5rem;"></i>
            </div>
            <div>
              <small class="text-muted d-block">Sedang Diproses</small>
              <h4 class="fw-bold mb-0" style="color: #f59e0b;">{{ $diproses ?? 0 }}</h4>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card border-0 shadow-sm hover-lift-card">
        <div class="card-body p-4">
          <div class="d-flex align-items-center">
            <div class="icon-box me-3" style="width: 55px; height: 55px; background: linear-gradient(135deg, #10b981, #059669); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
              <i class="bi bi-check-circle text-white" style="font-size: 1.5rem;"></i>
            </div>
            <div>
              <small class="text-muted d-block">Selesai</small>
              <h4 class="fw-bold mb-0" style="color: #10b981;">{{ $selesai ?? 0 }}</h4>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card border-0 shadow-sm hover-lift-card">
        <div class="card-body p-4">
          <div class="d-flex align-items-center">
            <div class="icon-box me-3" style="width: 55px; height: 55px; background: linear-gradient(135deg, #ef4444, #dc2626); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
              <i class="bi bi-x-circle text-white" style="font-size: 1.5rem;"></i>
            </div>
            <div>
              <small class="text-muted d-block">Ditolak</small>
              <h4 class="fw-bold mb-0" style="color: #ef4444;">{{ $ditolak ?? 0 }}</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div class="row g-4">
    <!-- Pengaduan Terbaru -->
    <div class="col-lg-12">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 p-4 d-flex justify-content-between align-items-center">
          <div>
            <h5 class="fw-bold mb-0">Pengaduan Terbaru</h5>
            <small class="text-muted" data_target="{{ $totalPengaduan }}">{{ $totalPengaduan }} pengaduan terakhir Anda</small>          </div>
          <a href="{{ route('riwayat') }}" class="btn btn-outline-primary btn-sm">
            <i class="bi bi-arrow-right me-1"></i>Lihat Semua
          </a>
        </div>

        <div class="card-body p-4">
          <div class="row g-3">
            @forelse($pengaduanTerbaru as $p)
              <div class="col-md-4">
                <div class="card border hover-card h-100">
                  <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                      <span class="badge bg-light text-dark">
                        #TKT-{{ str_pad($p->pengaduan_id, 3, '0', STR_PAD_LEFT) }}
                      </span>
                      <span class="badge
                        @if($p->status_pengaduan == 'Diproses') bg-warning text-dark
                        @elseif($p->status_pengaduan == 'Selesai') bg-success
                        @elseif($p->status_pengaduan == 'Ditolak') bg-danger
                        @else bg-secondary @endif">
                        {{ $p->status_pengaduan }}
                      </span>
                    </div>
                    <span class="badge mb-2"
                      style="background: #6B21A8;">
                      {{ $p->kategoriKomplain->nama_kategori ?? '-' }}
                    </span>
                    <p class="text-muted small mb-2 text-truncate">
                      {{ $p->deskripsi_kejadian }}
                    </p>
                    <small class="text-muted">
                      <i class="bi bi-calendar3 me-1"></i>
                      {{ \Carbon\Carbon::parse($p->tanggal_kejadian)->translatedFormat('d M Y') }}
                    </small>
                  </div>
                </div>
              </div>
            @empty
              <div class="col-12">
                <p class="text-center text-muted my-3">Belum ada pengaduan terbaru.</p>
              </div>
            @endforelse
          </div>
        </div>
      </div>
    </div>

    <!-- Tips & Info -->
    <div class="col-lg-6">
      <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #0ea5f0, #0284c7);">
        <div class="card-body p-4 text-white">
          <div class="d-flex align-items-center mb-3">
            <i class="bi bi-lightbulb me-3" style="font-size: 2rem;"></i>
            <h5 class="fw-bold mb-0">Tips Pengaduan Efektif</h5>
          </div>
          <ul class="mb-0 ps-3" style="font-size: 0.9rem; line-height: 1.8;">
            <li>Jelaskan masalah secara detail dan spesifik</li>
            <li>Sertakan bukti foto jika memungkinkan</li>
            <li>Cantumkan lokasi dan waktu kejadian</li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Quick Info -->
    <div class="col-lg-6">
      <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #6B21A8, #7C3AED);">
        <div class="card-body p-4 text-white">
          <div class="d-flex align-items-center mb-3">
            <i class="bi bi-info-circle me-3" style="font-size: 2rem;"></i>
            <h5 class="fw-bold mb-0">Informasi Penting</h5>
          </div>
          <p class="mb-2" style="font-size: 0.9rem;">⏱️ Pengaduan diproses maksimal <strong>3x24 jam</strong></p>
          <p class="mb-0" style="font-size: 0.9rem;">📧 Notifikasi dikirim via email untuk setiap update</p>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
.hover-lift-card {
  transition: all 0.3s ease;
}
.hover-lift-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
}
.hover-card {
  transition: all 0.3s ease;
  cursor: pointer;
}
.hover-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.1);
  border-color: #7C3AED !important;
}
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endsection
