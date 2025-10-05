@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <!-- Welcome Header -->
  <div class="row mb-4">
    <div class="col-12">
      <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #6B21A8 0%, #7C3AED 50%, #0ea5f0 100%); border-radius: 15px;">
        <div class="card-body p-4">
          <div class="d-flex align-items-center justify-content-between text-white">
            <div>
              <h3 class="fw-bold mb-2">Selamat Datang, {{ Auth::user()->nama ?? Auth::guard('admin')->user()->nama ?? 'User' }}! 👋</h3>
              <p class="mb-0 opacity-75">Kelola pengaduan Anda dengan mudah dan cepat</p>
            </div>
            <div class="d-none d-md-block">
              <a href="{{ route('pengaduan.create') }}" class="btn btn-light btn-lg px-4 shadow">
                <i class="bi bi-plus-circle me-2"></i>Buat Pengaduan Baru
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Quick Stats for User -->
  @auth
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
              <h4 class="fw-bold mb-0" style="color: #6B21A8;">8</h4>
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
              <h4 class="fw-bold mb-0" style="color: #f59e0b;">3</h4>
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
              <h4 class="fw-bold mb-0" style="color: #10b981;">5</h4>
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
              <h4 class="fw-bold mb-0" style="color: #ef4444;">0</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endauth

  <!-- Recent Activity / Info -->
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 p-4">
          <h5 class="fw-bold mb-0">Pengaduan Terbaru Anda</h5>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover mb-0">
              <thead style="background: #f8f9fa;">
                <tr>
                  <th class="px-4 py-3">No. Tiket</th>
                  <th class="py-3">Kategori</th>
                  <th class="py-3">Tanggal</th>
                  <th class="py-3">Status</th>
                  <th class="py-3">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="px-4 py-3"><span class="badge bg-light text-dark">#TKT-001</span></td>
                  <td class="py-3"><span class="badge" style="background: #6B21A8;">Akademik</span></td>
                  <td class="py-3">05 Okt 2025</td>
                  <td class="py-3"><span class="badge bg-warning">Diproses</span></td>
                  <td class="py-3">
                    <a href="#" class="btn btn-sm btn-outline-primary">Detail</a>
                  </td>
                </tr>
                <tr>
                  <td class="px-4 py-3"><span class="badge bg-light text-dark">#TKT-002</span></td>
                  <td class="py-3"><span class="badge" style="background: #0ea5f0;">Fasilitas</span></td>
                  <td class="py-3">03 Okt 2025</td>
                  <td class="py-3"><span class="badge bg-success">Selesai</span></td>
                  <td class="py-3">
                    <a href="#" class="btn btn-sm btn-outline-primary">Detail</a>
                  </td>
                </tr>
                <tr>
                  <td class="px-4 py-3"><span class="badge bg-light text-dark">#TKT-003</span></td>
                  <td class="py-3"><span class="badge" style="background: #f59e0b;">Layanan</span></td>
                  <td class="py-3">01 Okt 2025</td>
                  <td class="py-3"><span class="badge bg-success">Selesai</span></td>
                  <td class="py-3">
                    <a href="#" class="btn btn-sm btn-outline-primary">Detail</a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="p-3 text-center border-top">
            <a href="{{ route('riwayat') }}" class="btn btn-link text-decoration-none">
              Lihat Semua Pengaduan <i class="bi bi-arrow-right ms-1"></i>
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <!-- Quick Actions -->
      <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white border-0 p-4">
          <h5 class="fw-bold mb-0">Aksi Cepat</h5>
        </div>
        <div class="card-body p-4">
          <a href="{{ route('pengaduan.create') }}" class="btn w-100 mb-3 text-white" style="background: linear-gradient(135deg, #6B21A8, #7C3AED); border: none;">
            <i class="bi bi-plus-circle me-2"></i>Buat Pengaduan
          </a>
          <a href="{{ route('riwayat') }}" class="btn btn-outline-secondary w-100 mb-3">
            <i class="bi bi-clock-history me-2"></i>Lihat Riwayat
          </a>
          <a href="{{ route('profil') }}" class="btn btn-outline-secondary w-100">
            <i class="bi bi-person me-2"></i>Edit Profil
          </a>
        </div>
      </div>

      <!-- Info Box -->
      <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #0ea5f0, #0284c7);">
        <div class="card-body p-4 text-white">
          <div class="d-flex align-items-center mb-3">
            <i class="bi bi-info-circle me-2" style="font-size: 1.5rem;"></i>
            <h6 class="fw-bold mb-0">Informasi</h6>
          </div>
          <p class="mb-2" style="font-size: 0.9rem;">Pengaduan akan diproses maksimal 3x24 jam sejak diterima.</p>
          <p class="mb-0" style="font-size: 0.9rem;">Anda akan mendapat notifikasi via email untuk setiap update status pengaduan.</p>
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
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endsection