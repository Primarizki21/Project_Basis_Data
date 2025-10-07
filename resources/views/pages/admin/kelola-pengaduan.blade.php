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
                  <form action="{{ route('admin.kelola-pengaduan') }}" method="GET">
                      <div class="row g-3 align-items-end">
                          <div class="col-md-3">
                              <label class="form-label fw-semibold small">Cari Pengaduan</label>
                              <div class="input-group">
                                  <span class="input-group-text bg-white border-end-0">
                                      <i class="bi bi-search"></i>
                                  </span>
                                  <input type="text" name="search" class="form-control border-start-0" placeholder="No. tiket atau deskripsi..." value="{{ request('search') }}">
                              </div>
                          </div>

                          <div class="col-md-2">
                              <label class="form-label fw-semibold small">Status</label>
                              <select class="form-select" name="status">
                                  <option value="" {{ request('status') == '' ? 'selected' : '' }}>Semua Status</option>
                                  <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Belum Diproses</option>
                                  <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                                  <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                              </select>
                          </div>

                          <div class="col-md-2">
                              <label class="form-label fw-semibold small">Kategori</label>
                              <select class="form-select" name="kategori_komplain_id">
                                  <option value="" {{ request('kategori_komplain_id') == '' ? 'selected' : '' }}>Semua Kategori</option>
                                  @foreach($kategoriKomplains as $kategori)
                                      <option value="{{ $kategori->kategori_komplain_id }}" {{ request('kategori_komplain_id') == $kategori->kategori_komplain_id ? 'selected' : '' }}>
                                          {{ $kategori->jenis_komplain }}
                                      </option>
                                  @endforeach
                              </select>
                          </div>

                          <div class="col-md-2">
                              <label class="form-label fw-semibold small">Tanggal</label>
                              <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
                          </div>

                          <div class="col-md-3">
                              <label class="form-label fw-semibold small">&nbsp;</label>
                              <div class="d-flex gap-2">
                                  <button type="submit" class="btn btn-primary flex-grow-1">
                                      <i class="bi bi-funnel me-1"></i>Filter
                                  </button>
                                  <a href="{{ route('admin.kelola-pengaduan') }}" class="btn btn-outline-secondary" title="Reset Filter">
                                      <i class="bi bi-arrow-clockwise"></i>
                                  </a>
                              </div>
                          </div>
                      </div>
                  </form>
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
                        <h4 class="fw-bold mb-0" style="color: #6B21A8;">{{ $totalHariIni }}</h4>
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
                        <h4 class="fw-bold mb-0" style="color: #ef4444;">{{ $belumDiproses }}</h4>
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
                        <h4 class="fw-bold mb-0" style="color: #f59e0b;">{{ $sedangDiproses }}</h4>
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
                        <h4 class="fw-bold mb-0" style="color: #10b981;">{{ $selesaiMingguIni }}</h4>
                    </div>
                    <i class="bi bi-check-circle" style="font-size: 2rem; color: #10b981; opacity: 0.3;"></i>
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
            <small class="text-muted">{{ $pengaduans->total() }} total pengaduan ditemukan</small>
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
                @forelse($pengaduans as $pengaduan)
                <tr class="table-row-hover">
                  <td class="px-4 py-3">
                    <strong>#TKT-{{ $pengaduan->pengaduan_id }}</strong>
                  </td>
                  <td class="py-3">
                    <div>
                      {{-- Cek jika pelapor adalah user terdaftar atau anonim --}}
                      @if($pengaduan->pelapor)
                        <div class="fw-semibold">{{ $pengaduan->pelapor->nama }}</div>
                        <small class="text-muted">{{ $pengaduan->pelapor->email }}</small>
                      @else
                        <div class="fw-semibold">Anonim</div>
                        <small class="text-muted">Tidak terdaftar</small>
                      @endif
                    </div>
                  </td>
                  <td class="py-3">
                    <span class="badge" style="background-color: {{ $warnaKategori[$pengaduan->kategoriKomplain->jenis_komplain] ?? '#6c757d' }};">
                      {{ $pengaduan->kategoriKomplain->jenis_komplain }}
                    </span>
                  </td>
                  <td class="py-3">
                    <div class="text-truncate" style="max-width: 300px;">
                      {{ $pengaduan->deskripsi_kejadian }}
                    </div>
                  </td>
                  <td class="py-3">
                    <small>{{ $pengaduan->created_at->format('d M Y') }}<br>{{ $pengaduan->created_at->format('H:i') }}</small>
                  </td>
                  <td class="py-3">
                    @if($pengaduan->status_pengaduan == 'Selesai')
                      <span class="badge bg-success">Selesai</span>
                    @elseif($pengaduan->status_pengaduan == 'Diproses')
                      <span class="badge bg-warning">Sedang Diproses</span>
                    @else
                      <span class="badge bg-secondary">Belum Diproses</span>
                    @endif
                  </td>
                  <td class="py-3 text-center">
                    <div class="btn-group btn-group-sm">
                      <a href="{{ route('admin.pengaduan.edit', $pengaduan->pengaduan_id) }}" class="btn btn-outline-success" title="Proses"><i class="bi bi-gear"></i></a>
                      <form action="{{ route('admin.pengaduan.destroy', $pengaduan->pengaduan_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Anda yakin ingin menghapus pengaduan ini?');">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-outline-danger" title="Hapus">
                              <i class="bi bi-trash"></i>
                          </button>
                      </form>
                    </div>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="7" class="text-center py-5">
                    <h5 class="fw-bold">Tidak ada data pengaduan.</h5>
                  </td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
        
        <!-- Pagination -->
        <div class="card-footer bg-white border-0 p-4">
            <div class="d-flex justify-content-between align-items-center">
                {{-- Teks "Menampilkan X-Y dari Z" yang dibuat otomatis --}}
                <small class="text-muted">
                    Menampilkan {{ $pengaduans->firstItem() }} - {{ $pengaduans->lastItem() }} dari {{ $pengaduans->total() }} pengaduan
                </small>
                <div>
                    {{ $pengaduans->links() }}
                </div>
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

</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endsection