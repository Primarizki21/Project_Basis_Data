@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <!-- Page Header -->
  <div class="row mb-4">
    <div class="col-12">
      <h2 class="fw-bold mb-1">Riwayat Pengaduan</h2>
      <p class="text-muted mb-0">Daftar semua pengaduan yang pernah Anda ajukan</p>
    </div>
  </div>

  <!-- Filter Section -->
  <div class="row mb-4">
    <div class="col-12">
      <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
          <div class="row g-3">
            <div class="col-md-3">
              <label class="form-label fw-semibold small">Status</label>
              <select class="form-select">
                <option value="">Semua Status</option>
                <option value="menunggu">Menunggu</option>
                <option value="proses">Diproses</option>
                <option value="selesai">Selesai</option>
              </select>
            </div>
            <div class="col-md-3">
              <label class="form-label fw-semibold small">Kategori</label>
              <select class="form-select">
                <option value="">Semua Kategori</option>
                <option value="akademik">Akademik</option>
                <option value="fasilitas">Fasilitas</option>
                <option value="kekerasan">Kekerasan</option>
                <option value="kemahasiswaan">Kemahasiswaan</option>
                <option value="lainnya">Lainnya</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold small">&nbsp;</label>
              <div class="d-flex gap-2">
                <button class="btn btn-primary">
                  <i class="bi bi-funnel me-2"></i>Filter
                </button>
                <button class="btn btn-outline-secondary">
                  <i class="bi bi-arrow-clockwise me-2"></i>Reset
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Table -->
  <div class="row">
    <div class="col-12">
      <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover mb-0">
              <thead style="background: linear-gradient(135deg, #f8f9fa, #e9ecef);">
                <tr>
                  <th class="px-4 py-3">No. Tiket</th>
                  <th class="py-3">Kategori</th>
                  <th class="py-3">Deskripsi</th>
                  <th class="py-3">Tanggal</th>
                  <th class="py-3">Status</th>
                  <th class="py-3">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="px-4 py-3"><span class="badge bg-light text-dark fw-bold">#TKT-001</span></td>
                  <td class="py-3"><span class="badge" style="background: #6B21A8;">Akademik</span></td>
                  <td class="py-3">
                    <div style="max-width: 300px;">
                      <p class="mb-0 text-truncate">AC di ruang kelas rusak...</p>
                    </div>
                  </td>
                  <td class="py-3"><small class="text-muted">05 Okt 2025</small></td>
                  <td class="py-3"><span class="badge bg-warning">Diproses</span></td>
                  <td class="py-3">
                    <button class="btn btn-sm btn-outline-primary">Detail</button>
                  </td>
                </tr>
                <tr>
                  <td class="px-4 py-3"><span class="badge bg-light text-dark fw-bold">#TKT-002</span></td>
                  <td class="py-3"><span class="badge" style="background: #0ea5f0;">Fasilitas</span></td>
                  <td class="py-3">
                    <div style="max-width: 300px;">
                      <p class="mb-0 text-truncate">Toilet kotor tidak ada air...</p>
                    </div>
                  </td>
                  <td class="py-3"><small class="text-muted">03 Okt 2025</small></td>
                  <td class="py-3"><span class="badge bg-success">Selesai</span></td>
                  <td class="py-3">
                    <button class="btn btn-sm btn-outline-primary">Detail</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="p-4 border-top">
            <p class="text-muted small mb-0">Menampilkan 2 pengaduan</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endsection