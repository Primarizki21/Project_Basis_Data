@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <!-- Page Header -->
  <div class="row mb-4">
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h2 class="fw-bold mb-1">Riwayat Pengaduan</h2>
          <p class="text-muted mb-0">Lihat dan lacak semua pengaduan yang pernah Anda buat</p>
        </div>
        <a href="{{ route('pengaduan.create') }}" class="btn btn-primary">
          <i class="bi bi-plus-circle me-2"></i>Buat Pengaduan Baru
        </a>
      </div>
    </div>
  </div>

  <!-- Filter & Search -->
  <div class="row mb-4">
    <div class="col-12">
      <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
          <div class="row g-3">
            <div class="col-md-4">
              <label class="form-label fw-semibold">Cari Pengaduan</label>
              <div class="input-group">
                <span class="input-group-text bg-white border-end-0">
                  <i class="bi bi-search"></i>
                </span>
                <input type="text" class="form-control border-start-0" placeholder="Cari berdasarkan deskripsi atau nomor tiket...">
              </div>
            </div>
            <div class="col-md-3">
              <label class="form-label fw-semibold">Status</label>
              <select class="form-select">
                <option value="">Semua Status</option>
                <option value="pending">Belum Diproses</option>
                <option value="progress">Sedang Diproses</option>
                <option value="done">Selesai</option>
                <option value="rejected">Ditolak</option>
              </select>
            </div>
            <div class="col-md-3">
              <label class="form-label fw-semibold">Kategori</label>
              <select class="form-select">
                <option value="">Semua Kategori</option>
                <option value="1">Akademik</option>
                <option value="2">Fasilitas</option>
                <option value="3">Layanan</option>
                <option value="4">Lainnya</option>
              </select>
            </div>
            <div class="col-md-2">
              <label class="form-label fw-semibold">&nbsp;</label>
              <button class="btn btn-outline-secondary w-100">
                <i class="bi bi-funnel me-2"></i>Filter
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Pengaduan List -->
<div class="row g-4">
  @forelse($pengaduan as $p)
    <div class="col-12">
      <div class="card border-0 shadow-sm hover-card">
        <div class="card-body p-4">
          <div class="row">
            <div class="col-lg-8">
              <div class="d-flex align-items-start mb-3">
                <div class="me-3">
                  <div class="icon-box" style="width: 50px; height: 50px; background: linear-gradient(135deg, #6B21A8, #7C3AED); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-file-earmark-text text-white" style="font-size: 1.5rem;"></i>
                  </div>
                </div>
                <div class="flex-grow-1">
                  <div class="d-flex align-items-center mb-2">
                    <span class="badge bg-light text-dark me-2">#{{ $p->pengaduan_id }}</span>
                    <span class="badge" style="background: #6B21A8;">{{ $p->kategoriKomplain->jenis_komplain }}</span>
                  </div>
                  <h5 class="fw-bold mb-2">{{ Str::limit($p->deskripsi_kejadian, 80) }}</h5>
                  <p class="text-muted mb-2">{{ Str::limit($p->deskripsi_kejadian, 150) }}</p>
                  <div class="d-flex align-items-center text-muted small">
                    <i class="bi bi-calendar3 me-1"></i>
                    <span class="me-3">{{ $p->tanggal_kejadian ? \Carbon\Carbon::parse($p->tanggal_kejadian)->format('d M Y') : '-' }}</span>
                    <i class="bi bi-clock me-1"></i>
                    <span>{{ $p->created_at->format('H:i') }} WIB</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="d-flex flex-column h-100 justify-content-between">
                <div class="mb-3">
                  <label class="small text-muted mb-1">Status</label>
                  <div>
                    @if($p->status_pengaduan == 'Menunggu')
                      <span class="badge bg-secondary px-3 py-2">
                        <i class="bi bi-clock me-1"></i>Menunggu
                      </span>
                    @elseif($p->status_pengaduan == 'Diproses')
                      <span class="badge bg-warning px-3 py-2">
                        <i class="bi bi-hourglass-split me-1"></i>Diproses
                      </span>
                    @else
                      <span class="badge bg-success px-3 py-2">
                        <i class="bi bi-check-circle me-1"></i>Selesai
                      </span>
                    @endif
                  </div>
                </div>
                <div class="d-flex gap-2">
                  <a href="{{ route('pengaduan.edit', $p->pengaduan_id) }}" class="btn btn-outline-primary flex-grow-1">
                    <i class="bi bi-pencil me-1"></i>Edit
                  </a>
                  <form action="{{ route('pengaduan.destroy', $p->pengaduan_id) }}" method="POST" onsubmit="return confirm('Yakin hapus pengaduan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @empty
    <!-- Empty State -->
    <div class="col-12">
      <div class="text-center py-5">
        <div class="mb-4">
          <i class="bi bi-inbox" style="font-size: 4rem; color: #d1d5db;"></i>
        </div>
        <h4 class="fw-bold mb-2">Belum Ada Pengaduan</h4>
        <p class="text-muted mb-4">Anda belum pernah membuat pengaduan. Mulai buat pengaduan pertama Anda!</p>
        <a href="{{ route('pengaduan.create') }}" class="btn btn-primary">
          <i class="bi bi-plus-circle me-2"></i>Buat Pengaduan Baru
        </a>
      </div>
    </div>
  @endforelse
</div>
          
          <!-- Progress Timeline (if in progress) -->
          <div class="mt-3 pt-3 border-top">
            <small class="text-muted fw-semibold">Progress Tindak Lanjut:</small>
            <div class="progress mt-2" style="height: 8px;">
              <div class="progress-bar" style="width: 60%; background: linear-gradient(90deg, #6B21A8, #0ea5f0);" role="progressbar"></div>
            </div>
            <small class="text-muted mt-1 d-block">Terakhir diupdate: 05 Okt 2025, 15:20 WIB</small>
          </div>
        </div>
      </div>
    </div>

    <!-- Card Pengaduan 2 -->
    <div class="col-12">
      <div class="card border-0 shadow-sm hover-card">
        <div class="card-body p-4">
          <div class="row">
            <div class="col-lg-8">
              <div class="d-flex align-items-start mb-3">
                <div class="me-3">
                  <div class="icon-box" style="width: 50px; height: 50px; background: linear-gradient(135deg, #0ea5f0, #0284c7); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-building text-white" style="font-size: 1.5rem;"></i>
                  </div>
                </div>
                <div class="flex-grow-1">
                  <div class="d-flex align-items-center mb-2">
                    <span class="badge bg-light text-dark me-2">#TKT-2024-002</span>
                    <span class="badge" style="background: #0ea5f0;">Fasilitas</span>
                  </div>
                  <h5 class="fw-bold mb-2">AC Ruang Lab 301 Tidak Berfungsi</h5>
                  <p class="text-muted mb-2">AC di ruang laboratorium 301 sudah tidak berfungsi sejak 3 hari yang lalu. Ruangan menjadi sangat panas dan tidak nyaman untuk praktikum...</p>
                  <div class="d-flex align-items-center text-muted small">
                    <i class="bi bi-calendar3 me-1"></i>
                    <span class="me-3">03 Oktober 2025</span>
                    <i class="bi bi-clock me-1"></i>
                    <span>09:15 WIB</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="d-flex flex-column h-100 justify-content-between">
                <div class="mb-3">
                  <label class="small text-muted mb-1">Status</label>
                  <div>
                    <span class="badge bg-success px-3 py-2">
                      <i class="bi bi-check-circle me-1"></i>Selesai
                    </span>
                  </div>
                </div>
                <div class="d-flex gap-2">
                  <button class="btn btn-outline-primary flex-grow-1">
                    <i class="bi bi-eye me-1"></i>Detail
                  </button>
                  <button class="btn btn-outline-success">
                    <i class="bi bi-star"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Resolution Info (if done) -->
          <div class="mt-3 pt-3 border-top">
            <div class="alert alert-success mb-0 d-flex align-items-start">
              <i class="bi bi-check-circle-fill me-2 mt-1"></i>
              <div>
                <strong>Pengaduan Selesai</strong>
                <p class="mb-0 small">AC telah diperbaiki oleh tim maintenance pada 04 Okt 2025. Terima kasih atas laporannya.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Card Pengaduan 3 -->
    <div class="col-12">
      <div class="card border-0 shadow-sm hover-card">
        <div class="card-body p-4">
          <div class="row">
            <div class="col-lg-8">
              <div class="d-flex align-items-start mb-3">
                <div class="me-3">
                  <div class="icon-box" style="width: 50px; height: 50px; background: linear-gradient(135deg, #f59e0b, #d97706); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-people text-white" style="font-size: 1.5rem;"></i>
                  </div>
                </div>
                <div class="flex-grow-1">
                  <div class="d-flex align-items-center mb-2">
                    <span class="badge bg-light text-dark me-2">#TKT-2024-003</span>
                    <span class="badge" style="background: #f59e0b;">Layanan</span>
                  </div>
                  <h5 class="fw-bold mb-2">Pelayanan Administrasi Lambat</h5>
                  <p class="text-muted mb-2">Proses pengurusan KHS dan transkrip nilai di bagian administrasi memakan waktu terlalu lama. Sudah 2 minggu belum selesai...</p>
                  <div class="d-flex align-items-center text-muted small">
                    <i class="bi bi-calendar3 me-1"></i>
                    <span class="me-3">01 Oktober 2025</span>
                    <i class="bi bi-clock me-1"></i>
                    <span>11:45 WIB</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="d-flex flex-column h-100 justify-content-between">
                <div class="mb-3">
                  <label class="small text-muted mb-1">Status</label>
                  <div>
                    <span class="badge bg-secondary px-3 py-2">
                      <i class="bi bi-clock me-1"></i>Belum Diproses
                    </span>
                  </div>
                </div>
                <div class="d-flex gap-2">
                  <button class="btn btn-outline-primary flex-grow-1">
                    <i class="bi bi-eye me-1"></i>Detail
                  </button>
                  <button class="btn btn-outline-danger">
                    <i class="bi bi-trash"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Pagination -->
  <div class="row mt-4">
    <div class="col-12">
      <nav>
        <ul class="pagination justify-content-center">
          <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1">Previous</a>
          </li>
          <li class="page-item active"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#">Next</a>
          </li>
        </ul>
      </nav>
    </div>
  </div>

  <!-- Empty State (jika tidak ada data) -->
  <!-- Uncomment jika ingin pakai empty state
  <div class="row">
    <div class="col-12">
      <div class="text-center py-5">
        <div class="mb-4">
          <i class="bi bi-inbox" style="font-size: 4rem; color: #d1d5db;"></i>
        </div>
        <h4 class="fw-bold mb-2">Belum Ada Pengaduan</h4>
        <p class="text-muted mb-4">Anda belum pernah membuat pengaduan. Mulai buat pengaduan pertama Anda!</p>
        <a href="{{ route('pengaduan.create') }}" class="btn btn-primary">
          <i class="bi bi-plus-circle me-2"></i>Buat Pengaduan Baru
        </a>
      </div>
    </div>
  </div>
  -->
</div>

<style>
.hover-card {
  transition: all 0.3s ease;
}

.hover-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
}

.btn-outline-primary:hover {
  background: linear-gradient(135deg, #6B21A8, #7C3AED);
  border-color: #6B21A8;
  color: white;
}

.pagination .page-link {
  color: #6B21A8;
  border: 1px solid #e5e7eb;
  margin: 0 3px;
  border-radius: 8px;
}

.pagination .page-item.active .page-link {
  background: linear-gradient(135deg, #6B21A8, #7C3AED);
  border-color: #6B21A8;
}

.pagination .page-link:hover {
  background: #f3f4f6;
  border-color: #6B21A8;
}
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endsection