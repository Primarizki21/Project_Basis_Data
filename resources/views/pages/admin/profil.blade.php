@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold mb-1">Profil Administrator</h2>
            <p class="text-muted mb-0">Informasi akun dan keamanan Anda</p>
        </div>
    </div>

    <div class="row g-4">
        <!-- Profile Info Card -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 text-center">
                    <!-- Avatar -->
                    <div class="mb-3">
                        <div class="mx-auto" style="width: 120px; height: 120px; border-radius: 20px; background: linear-gradient(135deg, #6B21A8, #0ea5f0); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 3rem; box-shadow: 0 10px 30px rgba(107, 33, 168, 0.3);">
                            {{ strtoupper(substr(Auth::guard('admin')->user()->nama ?? 'A', 0, 1)) }}
                        </div>
                    </div>

                    <!-- Admin Info -->
                    <h4 class="fw-bold mb-1">{{ Auth::guard('admin')->user()->nama ?? 'Administrator' }}</h4>
                    <p class="text-muted mb-2">{{ Auth::guard('admin')->user()->email ?? 'admin@mail.com' }}</p>
                    <span class="badge px-3 py-2" style="background: linear-gradient(135deg, #6B21A8, #0ea5f0);">
                        <i class="bi bi-shield-check me-1"></i>Administrator
                    </span>

                    <!-- Stats for ADMIN -->
                    <div class="row mt-4 text-center">
                        <div class="col-4">
                            <h5 class="fw-bold mb-0" style="color: #6B21A8;">{{ $totalPengaduan ?? 0 }}</h5>
                            <small class="text-muted">Total Aduan</small>
                        </div>
                        <div class="col-4">
                            <h5 class="fw-bold mb-0" style="color: #10b981;">{{ $selesai ?? 0 }}</h5>
                            <small class="text-muted">Selesai</small>
                        </div>
                        <div class="col-4">
                            <h5 class="fw-bold mb-0" style="color: #0ea5f0;">
                                @php
                                    $persentase = ($totalPengaduan ?? 0) > 0
                                        ? round(($selesai / $totalPengaduan) * 100)
                                        : 0;
                                @endphp
                                {{ $persentase }}%
                            </h5>
                            <small class="text-muted">Resolved</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">Aksi Cepat</h6>
                    <a href="{{ route('admin.dashboard') }}" class="btn w-100 mb-2 text-white" style="background: linear-gradient(135deg, #6B21A8, #0ea5f0); border: none;">
                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                    </a>
                    <a href="{{ route('admin.kelola-pengaduan') }}" class="btn btn-outline-primary w-100 mb-2">
                        <i class="bi bi-inbox me-2"></i>Kelola Pengaduan
                    </a>
                    {{-- Ganti 'admin.visualisasi' jika nama route berbeda --}}
                    {{-- <a href="{{ route('admin.visualisasi') }}" class="btn btn-outline-secondary w-100">
                        <i class="bi bi-bar-chart me-2"></i>Visualisasi
                    </a> --}}
                </div>
            </div>
        </div>

        <!-- Info & Password Section -->
        <div class="col-lg-8">
            <!-- Personal Info -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 p-4">
                    <h5 class="fw-bold mb-0">Informasi Personal</h5>
                    <small class="text-muted">Data ini hanya bisa dilihat dan tidak dapat diubah melalui halaman ini.</small>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted small">Nama Lengkap</label>
                            <div class="form-control-plaintext fw-bold">{{ Auth::guard('admin')->user()->nama ?? '-' }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted small">Email</label>
                            <div class="form-control-plaintext fw-bold">{{ Auth::guard('admin')->user()->email ?? '-' }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted small">NIP</label>
                            <div class="form-control-plaintext fw-bold">{{ Auth::guard('admin')->user()->nip ?? '-' }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted small">No. Telepon</label>
                            <div class="form-control-plaintext fw-bold">{{ Auth::guard('admin')->user()->nomor_telepon ?? '-' }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted small">Jenis Kelamin</label>
                            <div class="form-control-plaintext fw-bold">{{ Auth::guard('admin')->user()->jenis_kelamin ?? '-' }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted small">Tanggal Lahir</label>
                            <div class="form-control-plaintext fw-bold">{{ Auth::guard('admin')->user()->tanggal_lahir ? \Carbon\Carbon::parse(Auth::guard('admin')->user()->tanggal_lahir)->format('d F Y') : '-' }}</div>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold text-muted small">Alamat</label>
                            <div class="form-control-plaintext fw-bold">{{ Auth::guard('admin')->user()->alamat ?? '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Change Password Section -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="fw-bold mb-0">Keamanan Akun</h5>
                            <small class="text-muted">Ubah password untuk keamanan akun Anda</small>
                        </div>
                        <button class="btn btn-outline-primary btn-sm" type="button" onclick="togglePasswordForm()">
                            <i class="bi bi-key me-1"></i>
                            <span id="toggleText">Ubah Password</span>
                        </button>
                    </div>
                </div>

                <div id="passwordForm" style="display: none;">
                    <div class="card-body p-4 border-top">
                        @if(session('success'))
                        <div class="alert alert-success">
                            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        </div>
                        @endif

                        @if($errors->any())
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-triangle me-2"></i>{{ $errors->first() }}
                        </div>
                        @endif

                        <form action="{{ route('admin.profil.password') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Password Lama <span class="text-danger">*</span></label>
                                <input type="password" name="old_password" class="form-control form-control-lg" placeholder="Masukkan password lama" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Password Baru <span class="text-danger">*</span></label>
                                <input type="password" name="new_password" class="form-control form-control-lg" placeholder="Min. 6 karakter" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                                <input type="password" name="new_password_confirmation" class="form-control form-control-lg" placeholder="Ulangi password baru" required>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-warning px-4">
                                    <i class="bi bi-shield-check me-2"></i>Update Password
                                </button>
                                <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordForm()">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function togglePasswordForm() {
    const form = document.getElementById('passwordForm');
    const toggleText = document.getElementById('toggleText');

    if (form.style.display === 'none') {
        form.style.display = 'block';
        toggleText.textContent = 'Tutup Form';
    } else {
        form.style.display = 'none';
        toggleText.textContent = 'Ubah Password';
    }
}
</script>

<style>
.form-control-plaintext {
    padding: 0.75rem 0;
    border-bottom: 1px solid #e5e7eb;
    color: #1f2937;
}
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endsection
