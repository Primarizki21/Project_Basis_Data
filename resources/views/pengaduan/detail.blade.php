@extends('layouts.app')

@section('content')
<div class="container-fluid">
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
                    <h2 class="fw-bold mb-1">Detail Pengaduan</h2>
                    <p class="text-muted mb-0">Informasi lengkap mengenai pengaduan Anda</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    @if(Auth::guard('admin')->check())
                    <div class="p-3 rounded mb-4" style="background-color: #e9ecef;">
                        <h5 class="fw-bold text-dark">Panel Admin</h5>
                        <hr>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-muted small">Status Pengaduan</label>
                            <div class="form-control-plaintext fw-bold
                                @if($pengaduan->status_pengaduan == 'Selesai') text-success
                                @elseif($pengaduan->status_pengaduan == 'Diproses') text-warning
                                @else text-secondary @endif">
                                {{ $pengaduan->status_pengaduan }}
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="mb-3 pb-2 border-bottom">
                        <label class="form-label fw-semibold text-muted small">Kategori Pengaduan</label>
                        <div class="form-control-plaintext fw-bold">{{ $pengaduan->kategoriKomplain->jenis_komplain }}</div>
                    </div>

                    <div class="mb-3 pb-2 border-bottom">
                        <label class="form-label fw-semibold text-muted small">Deskripsi Kejadian</label>
                        <div class="form-control-plaintext fw-bold">{{ $pengaduan->deskripsi_kejadian }}</div>
                    </div>

                    <div class="mb-3 pb-2 border-bottom">
                        <label class="form-label fw-semibold text-muted small">Tanggal Kejadian</label>
                        <div class="form-control-plaintext fw-bold">{{ \Carbon\Carbon::parse($pengaduan->tanggal_kejadian)->translatedFormat('l, d F Y') }}</div>
                    </div>

                    <div class="mb-3 pb-2 border-bottom">
                        <label class="form-label fw-semibold text-muted small">Kategori Pengaduan</label>
                        <div class="form-control-plaintext fw-bold">
                            <span class="badge fs-6" style="background-color: {{ $warnaKategori[$pengaduan->kategoriKomplain->jenis_komplain] ?? '#6c757d' }};">
                                {{ $pengaduan->kategoriKomplain->jenis_komplain ?? '-' }}
                            </span>
                        </div>
                    </div>

                    <div class="mb-3 pb-2 border-bottom">
                        <label class="form-label fw-semibold text-muted small">Status Pengaduan</label>
                        <div class="form-control-plaintext fw-bold">
                            @if($pengaduan->status_pengaduan == 'Selesai')
                                <span class="badge fs-6 bg-success"><i class="bi bi-check-circle me-1"></i>Selesai</span>
                            @elseif($pengaduan->status_pengaduan == 'Diproses')
                                <span class="badge fs-6 bg-warning text-dark"><i class="bi bi-gear me-1"></i>Diproses</span>
                            @else
                                <span class="badge fs-6 bg-secondary"><i class="bi bi-hourglass me-1"></i>Menunggu</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 pb-2 border-bottom">
                        <label class="form-label fw-semibold text-muted small">Status Pelapor</label>
                        <div class="form-control-plaintext fw-bold">{{ $pengaduan->status_pelapor }}</div>
                    </div>
                    
                    <div class="mb-3 pb-2 border-bottom">
                        <label class="form-label fw-semibold text-muted small">Tanggal Dibuat</label>
                        <div class="form-control-plaintext fw-bold">{{ \Carbon\Carbon::parse($pengaduan->created_at)->translatedFormat('l, d F Y') }}</div>
                    </div>

                    <div class="mb-3 pb-2 border-bottom">
                        <label class="form-label fw-semibold text-muted small">Bukti Terlampir</label>
                        @if($pengaduan->bukti && count($pengaduan->bukti) > 0)
                            <div class="list-group mt-2">
                                @foreach($pengaduan->bukti as $bukti)
                                    <a href="{{ asset('storage/' . $bukti->path_file) }}" target="_blank" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        <span>
                                            <i class="bi bi-file-earmark-text me-2"></i>
                                            {{ $bukti->nama_file }}
                                        </span>
                                        <i class="bi bi-box-arrow-up-right"></i>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <div class="text-muted mt-2">Tidak ada bukti yang dilampirkan.</div>
                        @endif
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                 <div class="card-header bg-white border-0 py-3">
                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-clock-history me-2"></i>Riwayat Tindak Lanjut
                    </h5>
                </div>
                <div class="card-body">
                    @forelse($pengaduan->tindakLanjut->sortByDesc('created_at') as $tindakLanjut)
                        <div class="d-flex mb-3 pb-3 @if(!$loop->last) border-bottom @endif">
                            <div class="me-3">
                                <i class="bi bi-person-check-fill fs-4 text-success"></i>
                            </div>
                            <div>
                                <p class="mb-1">{{ $tindakLanjut->deskripsi }}</p>
                                <small class="text-muted d-block">
                                    <strong>{{ $tindakLanjut->handler->nama ?? 'Admin' }}</strong>
                                </small>
                                <small class="text-muted">
                                    {{ $tindakLanjut->created_at->diffForHumans() }}
                                </small>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4 text-muted">
                            <i class="bi bi-hourglass-split fs-2"></i>
                            <p class="mt-2 mb-0">Belum ada tindak lanjut.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endsection