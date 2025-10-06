@extends('layouts.app')

@section('content')
<div class="container-fluid animate-fade-in">
  <!-- Page Header -->
  <div class="row mb-4">
    <div class="col-12">
      <h2 class="fw-bold mb-2">Kelola Pengaduan</h2>
      <p class="text-muted">Manajemen dan tindak lanjut semua pengaduan</p>
    </div>
  </div>

  <!-- Filter & Search Bar -->
  <div class="row mb-4">
    <div class="col-12">
      <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
          <div class="row g-3">
            <div class="col-md-3">
              <label class="form-label fw-semibold small">Cari Pengaduan</label>
              <div class="input-group">
                <span class="input-group-text bg-white border-end-0">
                  <i class="bi bi-search"></i>
                </span>
                <input type="text" class="form-control border-start-0" placeholder="No. tiket atau deskripsi...">
              </div>
            </div>

            <div class="col-md-2">
              <label class="form-label fw-semibold small">Status</label>
              <select class="form-select">
                <option value="">Semua Status</option>
                <option value="menunggu">Belum Diproses</option>
                <option value="diproses">Sedang Diproses</option>
                <option value="selesai">Selesai</option>
              </select>
            </div>

            <div class="col-md-2">
              <label class="form-label fw-semibold small">Kategori</label>
              <select class="form-select">
                <option value="">Semua Kategori</option>
                <option value="1">Akademik</option>
                <option value="2">Fasilitas</option>
                <option value="3">Kekerasan</option>
                <option value="4">Kemahasiswaan</option>
                <option value="5">Lainnya</option>
              </select>
            </div>

            <div class="col-md-2">
              <label class="form-label fw-semibold small">Tanggal</label>
              <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
            </div>

            <div class="col-md-3">
              <label class="form-label fw-semibold small">&nbsp;</label>
              <div class="d-flex gap-2">
                <button class="btn btn-primary flex-grow-1">
                  <i class="bi bi-funnel me-1"></i>Filter
                </button>
                <button class="btn btn-outline-secondary">
                  <i class="bi bi-arrow-clockwise"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Quick Stats -->
  <div class="row g-3 mb-4">
    <div class="col-md-3">
      <div class="card border-0 shadow-sm hover-card" style="cursor: pointer;">
        <div class="card-body p-3">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <small class="text-muted d-block">Total Hari Ini</small>
              <h4 class="fw-bold mb-0" style="color: #6B21A8;">12</h4>
            </div>
            <i class="bi bi-inbox" style="font-size: 2rem; color: #6B21A8; opacity: 0.3;"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card border-0 shadow-sm hover-card" style="cursor: pointer;">
        <div class="card-body p-3">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <small class="text-muted d-block">Belum Diproses</small>
              <h4 class="fw-bold mb-0" style="color: #ef4444;">8</h4>
            </div>
            <i class="bi bi-hourglass-split" style="font-size: 2rem; color: #ef4444; opacity: 0.3;"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card border-0 shadow-sm hover-card" style="cursor: pointer;">
        <div class="card-body p-3">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <small class="text-muted d-block">Sedang Diproses</small>
              <h4 class="fw-bold mb-0" style="color: #f59e0b;">15</h4>
            </div>
            <i class="bi bi-gear" style="font-size: 2rem; color: #f59e0b; opacity: 0.3;"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card border-0 shadow-sm hover-card" style="cursor: pointer;">
        <div class="card-body p-3">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <small class="text-muted d-block">Selesai Minggu Ini</small>
              <h4 class="fw-bold mb-0" style="color: #10b981;">34</h4>
            </div>
            <i class="bi bi-check-circle" style="font-size: 2rem; color: #10b981; opacity: 0.3;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Table Pengaduan -->
  <div class="row">
    <div class="col-12">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 p-4 d-flex justify-content-between align-items-center">
          <div>
            <h5 class="fw-bold mb-0">Daftar Pengaduan</h5>
            <small class="text-muted">156 total pengaduan ditemukan</small>
          </div>
          <button class="btn btn-success">
            <i class="bi bi-download me-2"></i>Export Excel
          </button>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover mb-0">
              <thead style="background: #f8f9fa;">
                <tr>
                  <th class="px-4 py-3">No. Tiket</th>
                  <th class="py-3">Pelapor</th>
                  <th class="py-3">Kategori</th>
                  <th class="py-3">Deskripsi</th>
                  <th class="py-3">Tanggal</th>
                  <th class="py-3">Status</th>
                  <th class="py-3 text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <!-- Row 1 - Urgent -->
                <tr class="table-row-hover">
                  <td class="px-4 py-3">
                    <div class="d-flex align-items-center">
                      <span class="badge bg-danger me-2">!</span>
                      <strong>#TKT-156</strong>
                    </div>
                  </td>
                  <td class="py-3">
                    <div>
                      <div class="fw-semibold">Ahmad Rizki</div>
                      <small class="text-muted">TSD 2023</small>
                    </div>
                  </td>
                  <td class="py-3">
                    <span class="badge" style="background: #ef4444;">Kekerasan</span>
                  </td>
                  <td class="py-3">
                    <div class="text-truncate" style="max-width: 300px;">
                      Bullying verbal oleh senior di kelas...
                    </div>
                  </td>
                  <td class="py-3">
                    <small>06 Okt 2025<br>14:30</small>
                  </td>
                  <td class="py-3">
                    <span class="badge bg-secondary">Belum Diproses</span>
                  </td>
                  <td class="py-3 text-center">
                    <div class="btn-group btn-group-sm">
                      <button class="btn btn-outline-primary" title="Lihat Detail">
                        <i class="bi bi-eye"></i>
                      </button>
                      <button class="btn btn-outline-success" title="Proses">
                        <i class="bi bi-gear"></i>
                      </button>
                      <button class="btn btn-outline-danger" title="Hapus">
                        <i class="bi bi-trash"></i>
                      </button>
                    </div>
                  </td>
                </tr>

                <!-- Row 2 - Processing -->
                <tr class="table-row-hover">
                  <td class="px-4 py-3">
                    <strong>#TKT-155</strong>
                  </td>
                  <td class="py-3">
                    <div>
                      <div class="fw-semibold">Siti Nurhaliza</div>
                      <small class="text-muted">TSD 2024</small>
                    </div>
                  </td>
                  <td class="py-3">
                    <span class="badge" style="background: #0ea5f0;">Fasilitas</span>
                  </td>
                  <td class="py-3">
                    <div class="text-truncate" style="max-width: 300px;">
                      Toilet lantai 2 kotor dan tidak ada air...
                    </div>
                  </td>
                  <td class="py-3">
                    <small>05 Okt 2025<br>10:15</small>
                  </td>
                  <td class="py-3">
                    <span class="badge bg-warning">Sedang Diproses</span>
                  </td>
                  <td class="py-3 text-center">
                    <div class="btn-group btn-group-sm">
                      <button class="btn btn-outline-primary">
                        <i class="bi bi-eye"></i>
                      </button>
                      <button class="btn btn-outline-success">
                        <i class="bi bi-check2"></i>
                      </button>
                      <button class="btn btn-outline-danger">
                        <i class="bi bi-trash"></i>
                      </button>
                    </div>
                  </td>
                </tr>

                <!-- Row 3 - Done -->
                <tr class="table-row-hover">
                  <td class="px-4 py-3">
                    <strong>#TKT-154</strong>
                  </td>
                  <td class="py-3">
                    <div>
                      <div class="fw-semibold">Budi Santoso</div>
                      <small class="text-muted">RK 2023</small>
                    </div>
                  </td>
                  <td class="py-3">
                    <span class="badge" style="background: #6B21A8;">Akademik</span>
                  </td>
                  <td class="py-3">
                    <div class="text-truncate" style="max-width: 300px;">
                      Nilai UAS tidak sesuai dengan yang diharapkan...
                    </div>
                  </td>
                  <td class="py-3">
                    <small>04 Okt 2025<br>08:20</small>
                  </td>
                  <td class="py-3">
                    <span class="badge bg-success">Selesai</span>
                  </td>
                  <td class="py-3 text-center">
                    <div class="btn-group btn-group-sm">
                      <button class="btn btn-outline-primary">
                        <i class="bi bi-eye"></i>
                      </button>
                      <button class="btn btn-outline-secondary" disabled>
                        <i class="bi bi-check-circle-fill"></i>
                      </button>
                      <button class="btn btn-outline-danger">
                        <i class="bi bi-trash"></i>
                      </button>
                    </div>
                  </td>
                </tr>

                <!-- Row 4 -->
                <tr class="table-row-hover">
                  <td class="px-4 py-3">
                    <strong>#TKT-153</strong>
                  </td>
                  <td class="py-3">
                    <div>
                      <div class="fw-semibold">Dewi Lestari</div>
                      <small class="text-muted">RN 2024</small>
                    </div>
                  </td>
                  <td class="py-3">
                    <span class="badge" style="background: #f59e0b;">Kemahasiswaan</span>
                  </td>
                  <td class="py-3">
                    <div class="text-truncate" style="max-width: 300px;">
                      Proses pengajuan surat rekomendasi terlalu lama...
                    </div>
                  </td>
                  <td class="py-3">
                    <small>03 Okt 2025<br>16:45</small>
                  </td>
                  <td class="py-3">
                    <span class="badge bg-secondary">Belum Diproses</span>
                  </td>
                  <td class="py-3 text-center">
                    <div class="btn-group btn-group-sm">
                      <button class="btn btn-outline-primary">
                        <i class="bi bi-eye"></i>
                      </button>
                      <button class="btn btn-outline-success">
                        <i class="bi bi-gear"></i>
                      </button>
                      <button class="btn btn-outline-danger">
                        <i class="bi bi-trash"></i>
                      </button>
                    </div>
                  </td>
                </tr>

                <!-- Row 5 -->
                <tr class="table-row-hover">
                  <td class="px-4 py-3">
                    <strong>#TKT-152</strong>
                  </td>
                  <td class="py-3">
                    <div>
                      <div class="fw-semibold">Eko Prasetyo</div>
                      <small class="text-muted">SMB 2023</small>
                    </div>
                  </td>
                  <td class="py-3">
                    <span class="badge" style="background: #0ea5f0;">Fasilitas</span>
                  </td>
                  <td class="py-3">
                    <div class="text-truncate" style="max-width: 300px;">
                      WiFi kampus sering putus dan lambat...
                    </div>
                  </td>
                  <td class="py-3">
                    <small>02 Okt 2025<br>13:10</small>
                  </td>
                  <td class="py-3">
                    <span class="badge bg-warning">Sedang Diproses</span>
                  </td>
                  <td class="py-3 text-center">
                    <div class="btn-group btn-group-sm">
                      <button class="btn btn-outline-primary">
                        <i class="bi bi-eye"></i>
                      </button>
                      <button class="btn btn-outline-success">
                        <i class="bi bi-check2"></i>
                      </button>
                      <button class="btn btn-outline-danger">
                        <i class="bi bi-trash"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        
        <!-- Pagination -->
        <div class="card-footer bg-white border-0 p-4">
          <div class="d-flex justify-content-between align-items-center">
            <small class="text-muted">Menampilkan 1-5 dari 156 pengaduan</small>
            <nav>
              <ul class="pagination pagination-sm mb-0">
                <li class="page-item disabled">
                  <a class="page-link" href="#">Previous</a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">...</a></li>
                <li class="page-item"><a class="page-link" href="#">32</a></li>
                <li class="page-item">
                  <a class="page-link" href="#">Next</a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
.animate-fade-in {
  animation: fadeIn 0.6s ease-out;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

.hover-card {
  transition: all 0.3s ease;
}

.hover-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.1) !important;
}

.table-row-hover {
  transition: all 0.2s ease;
}

.table-row-hover:hover {
  background: #f9fafb;
  transform: scale(1.01);
}

.btn-group-sm .btn {
  padding: 0.25rem 0.5rem;
}

.pagination .page-link {
  color: #6B21A8;
  border-color: #e5e7eb;
}

.pagination .page-item.active .page-link {
  background: #6B21A8;
  border-color: #6B21A8;
}
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endsection