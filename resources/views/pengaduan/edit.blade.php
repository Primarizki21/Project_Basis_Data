@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <!-- Page Header -->
  <div class="row mb-4">
    <div class="col-12">
      <div class="d-flex align-items-center">
        @if(Auth::guard('admin')->check())
          <a href="{{ route('admin.kelola-pengaduan') }}" class="btn btn-outline-secondary me-3">
            <i class="bi bi-arrow-left"></i>
          </a>
        @else
          <a href="{{ route('riwayat') }}" class="btn btn-outline-secondary me-3">
            <i class="bi bi-arrow-left"></i>
          </a>
        @endif
        <div>
          <h2 class="fw-bold mb-1">Edit Pengaduan</h2>
          <p class="text-muted mb-0">Ubah detail pengaduan Anda sebelum diproses</p>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-8">
      <!-- Alert Info -->
      <div class="alert alert-info d-flex align-items-center mb-4" role="alert">
        <i class="bi bi-info-circle-fill me-2"></i>
        <div>
          Anda hanya dapat mengedit pengaduan yang belum diproses oleh admin.
        </div>
      </div>

      <!-- Form Card -->
      <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
          {{-- Ini untuk cek yang update user atau admin --}}
          <form action="{{ Auth::guard('admin')->check() ? route('admin.pengaduan.update', $pengaduan) : route('pengaduan.update', $pengaduan) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @if(Auth::guard('admin')->check())
            <div class="p-3 rounded mb-4" style="background-color: #f8f9fa;">
                <h5 class="fw-bold">Panel Admin</h5>
                <hr>

                @if($pengaduan->tindakLanjut->isNotEmpty())
                <div class="mb-4">
                    <label class="form-label fw-semibold">Riwayat Tindak Lanjut</label>
                    <div class="list-group">
                        @foreach($pengaduan->tindakLanjut->sortByDesc('created_at') as $tindakLanjut)
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <p class="mb-1">{{ $tindakLanjut->deskripsi }}</p>
                                <small class="text-nowrap">{{ $tindakLanjut->created_at->diffForHumans() }}</small>
                            </div>
                            <small class="text-muted">Oleh: Admin ID {{ $tindakLanjut->admin_id }}</small>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                
                <div class="mb-3">
                    <label class="form-label fw-semibold">Ubah Status Pengaduan</label>
                    <select name="status_pengaduan" class="form-select form-select-lg" required>
                      {{-- Sementara ditolak hapus dulu, nanti ditambah --}}
                        @foreach(['Menunggu', 'Diproses', 'Selesai'] as $status)
                            <option value="{{ $status }}" @if(old('status_pengaduan', $pengaduan->status_pengaduan) == $status) selected @endif>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label fw-semibold">Tambah Catatan Tindak Lanjut Baru</label>
                    <textarea name="deskripsi_tindak_lanjut" rows="4" required class="form-control form-control-lg">{{ old('deskripsi_tindak_lanjut') }}</textarea>
                    <small class="text-muted">Catatan ini akan ditambahkan sebagai riwayat baru.</small>
                </div>
            </div>
            @endif

            <!-- Kategori -->
            <div class="mb-4">
              <label class="form-label fw-semibold">Kategori Pengaduan</label>
              <select name="kategori_komplain_id" class="form-select form-select-lg" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategori_komplain as $k)
                  <option value="{{ $k->kategori_komplain_id }}" @if($pengaduan->kategori_komplain_id == $k->kategori_komplain_id) selected @endif>
                    {{ $k->jenis_komplain }}
                  </option>
                @endforeach
              </select>
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
              <label class="form-label fw-semibold">Deskripsi Kejadian</label>
              <textarea name="deskripsi_kejadian" rows="6" required class="form-control form-control-lg">{{ $pengaduan->deskripsi_kejadian }}</textarea>
            </div>

            <!-- Tanggal Kejadian -->
            <div class="mb-4">
              <label class="form-label fw-semibold">Tanggal Kejadian</label>
              <input type="date" name="tanggal_kejadian" value="{{ $pengaduan->tanggal_kejadian }}" class="form-control form-control-lg">
            </div>

            <!-- Upload Bukti Baru -->
            <div class="mb-4">
              <label class="form-label fw-semibold">Upload Bukti Tambahan (Opsional)</label>
              <input type="file" name="bukti[]" multiple class="form-control" accept="image/*,.pdf">
              <small class="text-muted">Biarkan kosong jika tidak ingin menambah bukti</small>
            </div>

            <!-- Existing Files -->
            @if($pengaduan->bukti && count($pengaduan->bukti) > 0)
            <div class="mb-4">
              <label class="form-label fw-semibold">Bukti yang Sudah Ada</label>
              <div class="row g-2">
                @foreach($pengaduan->bukti as $bukti)
                <div class="col-md-4">
                  <div class="card">
                    <div class="card-body p-2">
                      <small class="d-block text-truncate">{{ $bukti->nama_file }}</small>
                      <button type="button" class="btn btn-sm btn-danger w-100 mt-1">Hapus</button>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
            @endif

            <!-- Buttons -->
            <div class="d-flex gap-3">
              <button type="submit" class="btn btn-lg text-white px-5" style="background: linear-gradient(135deg, #6B21A8, #7C3AED); border: none;">
                <i class="bi bi-save me-2"></i>Simpan Perubahan
              </button>
              @if(Auth::guard('admin')->check())
              <a href="{{ route('admin.kelola-pengaduan') }}" class="btn btn-lg btn-outline-secondary px-4">
                Batal
              </a>
              @else
              <a href="{{ route('riwayat') }}" class="btn btn-lg btn-outline-secondary px-4">
                Batal
              </a>
              @endif
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
      <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
        <div class="card-body p-4 text-white">
          <h6 class="fw-bold mb-3">
            <i class="bi bi-exclamation-triangle me-2"></i>Perhatian
          </h6>
          <ul class="mb-0 ps-3" style="font-size: 0.9rem;">
            <li class="mb-2">Setelah diproses admin, pengaduan tidak dapat diedit</li>
            <li class="mb-2">Pastikan informasi yang Anda berikan akurat</li>
            <li class="mb-0">Perubahan akan langsung tersimpan</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endsection