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
          <form action="{{ route('riwayat') }}" method="GET">
            <div class="row g-3">
              <div class="col-md-3">
                <label class="form-label fw-semibold small">Status</label>
                <select class="form-select" name="status">
                  <option value="" {{ request('status') == '' ? 'selected' : '' }}>Semua Status</option>
                  <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                  <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                  <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
              </div>
              {{-- Filter : Kategori --}}
              <div class="col-md-3">
                <label class="form-label fw-semibold small">Kategori</label>
                <select class="form-select" name="kategori_komplain_id">
                  <option value="">Semua Kategori</option>
                  <option value="1" {{ request('kategori_komplain_id') == '1' ? 'selected' : '' }}>Akademik</option>
                  <option value="2" {{ request('kategori_komplain_id') == '2' ? 'selected' : '' }}>Fasilitas</option>
                  <option value="3" {{ request('kategori_komplain_id') == '3' ? 'selected' : '' }}>Kekerasan</option>
                  <option value="4" {{ request('kategori_komplain_id') == '4' ? 'selected' : '' }}>Kemahasiswaan</option>
                  <option value="5" {{ request('kategori_komplain_id') == '5' ? 'selected' : '' }}>Lainnya</option>
                </select>
              </div>
              
              {{-- Filter: Tanggal --}}
              <div class="col-md-2">
                  <label class="form-label fw-semibold small">Tanggal</label>
                  <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
              </div>

              {{-- Filter : Search --}}
              <div class="col-md-4">
                  <label class="form-label fw-semibold small">Cari Tiket / Deskripsi</label>
                  <div class="input-group">
                      <span class="input-group-text bg-light"><i class="bi bi-search"></i></span>
                      <input type="text" 
                          name="search" 
                          class="form-control" 
                          placeholder="Cari..." 
                          value="{{ request('search') }}">
                  </div>
              </div>
              <div class="col-12 mt-3">
                  <div class="d-flex gap-2">
                      <button type="submit" class="btn btn-primary">
                          <i class="bi bi-funnel me-2"></i>Filter
                      </button>
                      <a href="{{ route('riwayat') }}" class="btn btn-outline-secondary">
                          <i class="bi bi-arrow-clockwise me-2"></i>Reset
                      </a>
                  </div>
              </div>
            </div>
          </form>
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
                  <th class="py-3 text-center">Aksi</th>
                </tr>
              </thead>

              <tbody>
                @if($pengaduan->isEmpty())
                  <tr>
                    <td colspan="6" class="text-center py-4 text-muted">
                      <i class="bi bi-inbox me-2"></i>Belum ada pengaduan yang diajukan.
                    </td>
                  </tr>
                @else
                  @foreach($pengaduan as $item)
                    <tr>
                      <td class="px-4 py-3">
                        <span class="badge bg-light text-dark fw-bold">
                          #TKT-{{ str_pad($item->pengaduan_id, 3, '0', STR_PAD_LEFT) }}
                        </span>
                      </td>

                      <td class="py-3">
                        <span class="badge"
                              style="background-color: {{ $warnaKategori[$item->kategoriKomplain->jenis_komplain] ?? '#6c757d' }};">
                          {{ $item->kategoriKomplain->jenis_komplain ?? '-' }}
                        </span>
                      </td>

                      <td class="py-3">
                        <div style="max-width: 300px;">
                          <p class="mb-0 text-truncate">{{ $item->deskripsi_kejadian }}</p>
                        </div>
                      </td>

                      <td class="py-3">
                        <small class="text-muted">
                          {{ $item->tanggal_kejadian ? \Carbon\Carbon::parse($item->tanggal_kejadian)->format('d M Y') : '-' }}
                        </small>
                      </td>

                      <td class="py-3">
                        @if($item->status_pengaduan == 'Menunggu')
                          <span class="badge bg-secondary">Belum Diproses</span>
                        @elseif($item->status_pengaduan == 'Diproses')
                          <span class="badge bg-warning">Sedang Diproses</span>
                        @elseif($item->status_pengaduan == 'Selesai')
                          <span class="badge bg-success">Selesai</span>
                        @endif
                      </td>

                      <td class="py-3 text-center">
                        <div class="btn-group btn-group-sm">
                          <a href="{{ route('pengaduan.show', $item->pengaduan_id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye"></i>
                          </a>
                          <a href="{{ route('pengaduan.edit', $item->pengaduan_id) }}" class="btn btn-sm btn-outline-success">
                            <i class="bi bi-gear"></i>
                          </a>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                @endif
              </tbody>
            </table>
          </div>

          <div class="p-4 border-top">
            <p class="text-muted small mb-0">
              Menampilkan {{ $pengaduan->count() }} pengaduan
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endsection
