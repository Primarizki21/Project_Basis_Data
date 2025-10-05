@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <!-- Page Header -->
  <div class="row mb-4">
    <div class="col-12">
      <h2 class="fw-bold mb-1">Profil Saya</h2>
      <p class="text-muted mb-0">Kelola informasi profil dan keamanan akun Anda</p>
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
              {{ strtoupper(substr(Auth::user()->nama ?? 'U', 0, 1)) }}
            </div>
          </div>

          <!-- User Info -->
          <h4 class="fw-bold mb-1">{{ Auth::user()->nama ?? 'User Name' }}</h4>
          <p class="text-muted mb-2">{{ Auth::user()->email ?? 'user@mail.com' }}</p>
          
          @auth
            <span class="badge bg-success px-3 py-2">
              <i class="bi bi-person me-1"></i>User
            </span>
          @endauth

          @auth('admin')
            <span class="badge px-3 py-2" style="background: linear-gradient(135deg, #6B21A8, #0ea5f0);">
              <i class="bi bi-shield-check me-1"></i>Administrator
            </span>
          @endauth

          <!-- Stats -->
          <div class="row mt-4 text-center">
            <div class="col-4">
              <h5 class="fw-bold mb-0" style="color: #6B21A8;">12</h5>
              <small class="text-muted">Pengaduan</small>
            </div>
            <div class="col-4">
              <h5 class="fw-bold mb-0" style="color: #0ea5f0;">8</h5>
              <small class="text-muted">Selesai</small>
            </div>
            <div class="col-4">
              <h5 class="fw-bold mb-0" style="color: #f59e0b;">4</h5>
              <small class="text-muted">Proses</small>
            </div>
          </div>
        </div>
      </div>

      <!-- Quick Actions -->
      <div class="card border-0 shadow-sm mt-4">
        <div class="card-body p-4">
          <h6 class="fw-bold mb-3">Aksi Cepat</h6>
          <a href="{{ route('pengaduan.create') }}" class="btn w-100 mb-2 text-white" style="background: linear-gradient(135deg, #6B21A8, #0ea5f0); border: none;">
            <i class="bi bi-plus-circle me-2"></i>Buat Pengaduan
          </a>
          <a href="{{ route('riwayat') }}" class="btn btn-outline-secondary w-100">
            <i class="bi bi-clock-history me-2"></i>Lihat Riwayat
          </a>
        </div>
      </div>
    </div>

    <!-- Edit Profile Form -->
    <div class="col-lg-8">
      <!-- Personal Info -->
      <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white border-0 p-4">
          <h5 class="fw-bold mb-0">Informasi Personal</h5>
        </div>
        <div class="card-body p-4">
          <form action="{{ route('profil.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label fw-semibold">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control form-control-lg" value="{{ Auth::user()->nama ?? '' }}" required>
              </div>

              <div class="col-md-6">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control form-control-lg" value="{{ Auth::user()->email ?? '' }}" required>
              </div>

              <div class="col-md-6">
                <label class="form-label fw-semibold">NIM / NIP</label>
                <input type="text" name="nim" class="form-control form-control-lg" value="{{ Auth::user()->nim ?? '' }}">
              </div>

              <div class="col-md-6">
                <label class="form-label fw-semibold">No. Telepon</label>
                <input type="tel" name="telepon" class="form-control form-control-lg" value="{{ Auth::user()->telepon ?? '' }}">
              </div>

              <div class="col-12">
                <label class="form-label fw-semibold">Program Studi</label>
                <input type="text" name="prodi" class="form-control form-control-lg" value="{{ Auth::user()->prodi ?? '' }}" placeholder="Contoh: Teknologi Sains Data">
              </div>
            </div>

            <div class="mt-4">
              <button type="submit" class="btn btn-primary px-4">
                <i class="bi bi-save me-2"></i>Simpan Perubahan
              </button>
            </div>
          </form>
        </div>
      </div>

      <!-- Change Password -->
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 p-4">
          <h5 class="fw-bold mb-0">Ubah Password</h5>
        </div>
        <div class="card-body p-4">
          <form action="{{ route('profil.password') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
              <label class="form-label fw-semibold">Password Lama</label>
              <input type="password" name="old_password" class="form-control form-control-lg" required>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Password Baru</label>
              <input type="password" name="new_password" class="form-control form-control-lg" required>
              <small class="text-muted">Minimal 8 karakter</small>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Konfirmasi Password Baru</label>
              <input type="password" name="new_password_confirmation" class="form-control form-control-lg" required>
            </div>

            <button type="submit" class="btn btn-warning px-4">
              <i class="bi bi-key me-2"></i>Update Password
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endsection