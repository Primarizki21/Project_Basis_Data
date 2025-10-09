@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Detail Profil User</h2>
            <p class="text-muted mb-0">Informasi akun dan riwayat pengaduan.</p>
        </div>
        <a href="{{ route('admin.kelola-user') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Kembali ke Kelola User
        </a>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 text-center">
                    <div class="mb-3">
                        <div class="mx-auto" style="width: 120px; height: 120px; border-radius: 20px; background: linear-gradient(135deg, #6B21A8, #0ea5f0); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 3rem; box-shadow: 0 10px 30px rgba(107, 33, 168, 0.3);">
                            {{ strtoupper(substr($user->nama ?? 'U', 0, 1)) }}
                        </div>
                    </div>

                    <h4 class="fw-bold mb-1">{{ $user->nama ?? 'User Name' }}</h4>
                    <p class="text-muted mb-2">{{ $user->email ?? 'user@mail.com' }}</p>
                    <span class="badge bg-success px-3 py-2">
                        <i class="bi bi-person me-1"></i>Mahasiswa
                    </span>

                    <div class="row mt-4 text-center">
                        <div class="col-3">
                            <h5 class="fw-bold mb-0" style="color: #6B21A8;">{{ $totalPengaduan ?? 0 }}</h5>
                            <small class="text-muted">Total</small>
                        </div>
                        <div class="col-3">
                            <h5 class="fw-bold mb-0" style="color: #f59e0b;">{{ $menunggu ?? 0 }}</h5>
                            <small class="text-muted">Menunggu</small>
                        </div>
                        <div class="col-3">
                            <h5 class="fw-bold mb-0" style="color: #0ea5f0;">{{ $diproses ?? 0 }}</h5>
                            <small class="text-muted">Diproses</small>
                        </div>
                        <div class="col-3">
                            <h5 class="fw-bold mb-0" style="color: #10b981;">{{ $selesai ?? 0 }}</h5>
                            <small class="text-muted">Selesai</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 p-4">
                    <h5 class="fw-bold mb-0">Informasi Personal</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted small">Nama Lengkap</label>
                            <div class="form-control-plaintext fw-bold">{{ $user->nama ?? '-' }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted small">Alamat Email</label>
                            <div class="form-control-plaintext fw-bold">{{ $user->email ?? '-' }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted small">NIM</label>
                            <div class="form-control-plaintext fw-bold">{{ $user->nim ?? '-' }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted small">Jenis Pekerjaan</label>
                            <div class="form-control-plaintext fw-bold">{{ $user->pekerjaanfk->nama_pekerjaan ?? '-' }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted small">Program Studi</label>
                            <div class="form-control-plaintext fw-bold">{{ $user->prodifk->nama_prodi ?? '-' }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted small">Angkatan</label>
                            <div class="form-control-plaintext fw-bold">{{ $user->angkatan ?? '-' }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted small">Jenis Kelamin</label>
                            <div class="form-control-plaintext fw-bold">{{ $user->jenis_kelamin ?? '-' }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted small">Tempat Lahir</label>
                            <div class="form-control-plaintext fw-bold">{{ $user->tempat_lahir ?? '-' }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted small">Tanggal Lahir</label>
                            <div class="form-control-plaintext fw-bold">{{ $user->tanggal_lahir ?? '-' }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted small">Alamat</label>
                            <div class="form-control-plaintext fw-bold">{{ $user->alamat ?? '-' }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted small">No. Telepon</label>
                            <div class="form-control-plaintext fw-bold">{{ $user->nomor_telepon ?? '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-control-plaintext {
    padding: 0.75rem 0;
    border-bottom: 1px solid #e5e7eb;
    color: #1f2937;
}
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endsection