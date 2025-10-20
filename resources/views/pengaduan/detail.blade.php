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
                        <div class="form-control-plaintext fw-bold">
                            <span class="badge fs-6" style="background-color: {{ $warnaKategori[$pengaduan->kategoriKomplain->jenis_komplain] ?? '#6c757d' }};">
                                {{ $pengaduan->kategoriKomplain->jenis_komplain ?? '-' }}
                            </span>
                        </div>
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
                            <div id="filePreview" class="mt-2">
                                @foreach($pengaduan->bukti as $bukti)
                                    @php
                                        $filePath = asset('storage/' . $bukti->file_path);
                                        $fileName = $bukti->nama_file;
                                        $extension = strtolower(pathinfo($bukti->file_path, PATHINFO_EXTENSION));
                                        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'];
                                        $isImage = in_array($extension, $imageExtensions);
                                        $fileSizeKB = (isset($bukti->ukuran_file)) ? round($bukti->ukuran_file / 1024, 2) : null;
                                    @endphp

                                    <div class="file-item">
                                        @if($isImage)
                                            <img src="{{ $filePath }}" alt="{{ $fileName }}" class="file-thumbnail"
                                                onclick="showImageModal('{{ $filePath }}')">
                                                
                                            <div class="flex-grow-1">
                                                <div class="fw-semibold">{{ $fileName }}</div>
                                                @if($fileSizeKB)
                                                    <small class="text-muted">{{ $fileSizeKB }} KB</small>
                                                @endif
                                            </div>
                                            <a href="{{ $filePath }}" target="_blank" class="ms-2 text-muted" title="Buka di tab baru">
                                                <i class="bi bi-box-arrow-up-right"></i>
                                            </a>
                                        @else
                                            <i class="bi bi-file-earmark-text file-icon"></i>
                                            <div class="flex-grow-1">
                                                <div class="fw-semibold">{{ $fileName }}</div>
                                                @if($fileSizeKB)
                                                    <small class="text-muted">{{ $fileSizeKB }} KB</small>
                                                @endif
                                            </div>
                                            <a href="{{ $filePath }}" target="_blank" class="ms-2 text-muted" title="Buka di tab baru">
                                                <i class="bi bi-box-arrow-up-right"></i>
                                            </a>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-muted mt-2">Tidak ada bukti yang dilampirkan.</div>
                        @endif
                    </div>
                    <div id="imageModal" class="image-preview-modal" onclick="closeImageModal()">
                        <span class="close-modal-btn" onclick="closeImageModal(event)">&times;</span>
                        <div class="modal-image-container" onclick="event.stopPropagation()">
                            <img class="modal-content" id="modalImage">
                        </div>
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

<style>
    #filePreview .file-item {
        display: flex;
        align-items: center;
        padding: 10px;
        background: #f9fafb;
        border-radius: 8px;
        margin-bottom: 8px;
        gap: 10px;
        border: 1px solid #eee;
        margin-top: 8px;
    }
    .file-thumbnail {
        width: 40px;
        height: 40px;
        object-fit: cover;
        border-radius: 4px;
        cursor: pointer;
    }
    .file-item > .bi {
        font-size: 1.5rem;
        color: #6c757d;
        width: 40px;
        text-align: center;
    }
    .file-item .flex-grow-1 {
        overflow: hidden;
    }
    .file-item .flex-grow-1 .fw-semibold {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    #filePreview .remove-file {
        margin-left: auto;
        cursor: pointer;
        color: #ef4444;
        font-size: 1.25rem;
    }
    .remove-file:hover {
        color: #a71d2a;
    }
    .image-preview-modal {
        display: none;
        position: fixed;
        z-index: 1001;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.85);
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }
    .modal-image-container {
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2), 0 6px 20px rgba(0, 0, 0, 0.19);
        background-color: transparent;
        line-height: 0;
    }
    .modal-content {
        display: block;
        object-fit: contain;
        max-width: 90%;
        max-height: 90vh;
        animation-name: zoom;
        animation-duration: 0.3s;
        cursor: default;
    }
    @keyframes zoom {
        from {transform: scale(0.8)}
        to {transform: scale(1)}
    }
    .close-modal-btn {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
        cursor: pointer;
    }
    .close-modal-btn:hover,
    .close-modal-btn:focus {
        color: #bbb;
        text-decoration: none;
    }
</style>

<script>
const modal = document.getElementById('imageModal');
const modalImage = document.getElementById('modalImage');
function showImageModal(src) {
  modal.style.display = "flex";
  modalImage.src = src;
}
function closeImageModal(event) {
  if (event) {
    event.stopPropagation(); 
  }
  modal.style.display = "none";
}
</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endsection