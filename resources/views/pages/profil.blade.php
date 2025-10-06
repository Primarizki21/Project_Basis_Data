@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <!-- Page Header -->
  <div class="row mb-4">
    <div class="col-12">
      <h2 class="fw-bold mb-1">Profil Saya</h2>
      <p class="text-muted mb-0">Informasi akun dan keamanan</p>
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
              @auth('web')
                {{ strtoupper(substr(Auth::user()->nama ?? 'U', 0, 1)) }}
              @endauth
              @auth('admin')
                {{ strtoupper(substr(Auth::guard('admin')->user()->nama ?? 'A', 0, 1)) }}
              @endauth
            </div>
          </div>

          <!-- User Info -->
          @auth('web')
            <h4 class="fw-bold mb-1">{{ Auth::user()->nama ?? 'User Name' }}</h4>
            <p class="text-muted mb-2">{{ Auth::user()->email ?? 'user@mail.com' }}</p>
            <span class="badge bg-success px-3 py-2">
              <i class="bi bi-person me-1"></i>Mahasiswa
            </span>

            <!-- Stats for USER -->
            <div class="row mt-4 text-center">
              <div class="col-4">
                <h5 class="fw-bold mb-0" style="color: #6B21A8;">12</h5>
                <small class="text-muted">Pengaduan</small>
              </div>
              <div class="col-4">
                <h5 class="fw-bold mb-0" style="color: #10b981;">8</h5>
                <small class="text-muted">Selesai</small>
              </div>
              <div class="col-4">
                <h5 class="fw-bold mb-0" style="color: #f59e0b;">4</h5>
                <small class="text-muted">Proses</small>
              </div>
            </div>
          @endauth

          @auth('admin')
            <h4 class="fw-bold mb-1">{{ Auth::guard('admin')->user()->nama ?? 'Administrator' }}</h4>
            <p class="text-muted mb-2">{{ Auth::guard('admin')->user()->email ?? 'admin@mail.com' }}</p>
            <span class="badge px-3 py-2" style="background: linear-gradient(135deg, #6B21A8, #0ea5f0);">
              <i class="bi bi-shield-check me-1"></i>Administrator
            </span>

            <!-- Stats for ADMIN -->
            <div class="row mt-4 text-center">
              <div class="col-4">
                <h5 class="fw-bold mb-0" style="color: #6B21A8;">1247</h5>
                <small class="text-muted">Total</small>
              </div>
              <div class="col-4">
                <h5 class="fw-bold mb-0" style="color: #10b981;">342</h5>
                <small class="text-muted">User</small>
              </div>
              <div class="col-4">
                <h5 class="fw-bold mb-0" style="color: #0ea5f0;">87%</h5>
                <small class="text-muted">Resolved</small>
              </div>
            </div>
          @endauth
        </div>
      </div>

      <!-- Quick Actions (Admin only) -->
      @auth('admin')
      <div class="card border-0 shadow-sm mt-4">
        <div class="card-body p-4">
          <h6 class="fw-bold mb-3">Aksi Cepat</h6>
          <a href="{{ route('admin.dashboard') }}" class="btn w-100 mb-2 text-white" style="background: linear-gradient(135deg, #6B21A8, #0ea5f0); border: none;">
            <i class="bi bi-speedometer2 me-2"></i>Dashboard
          </a>
          <a href="{{ route('admin.kelola-pengaduan') }}" class="btn btn-outline-primary w-100 mb-2">
            <i class="bi bi-inbox me-2"></i>Kelola Pengaduan
          </a>
          <a href="{{ route('admin.visualisasi') }}" class="btn btn-outline-secondary w-100">
            <i class="bi bi-bar-chart me-2"></i>Visualisasi
          </a>
        </div>
      </div>
      @endauth
    </div>

    <!-- Info & Password Section -->
    <div class="col-lg-8">
      <!-- Personal Info - READ ONLY -->
      <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white border-0 p-4">
          <h5 class="fw-bold mb-0">Informasi Personal</h5>
          <small class="text-muted">Data ini tidak dapat diubah. Hubungi admin jika ada kesalahan.</small>
        </div>
        <div class="card-body p-4">
          
          @auth('web')
          <!-- USER FIELDS -->
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label fw-semibold text-muted small">Nama Lengkap</label>
              <div class="form-control-plaintext fw-bold">{{ Auth::user()->nama ?? '-' }}</div>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold text-muted small">Email</label>
              <div class="form-control-plaintext fw-bold">{{ Auth::user()->email ?? '-' }}</div>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold text-muted small">NIM</label>
              <div class="form-control-plaintext fw-bold">{{ Auth::user()->nim ?? '-' }}</div>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold text-muted small">No. Telepon</label>
              <div class="form-control-plaintext fw-bold">{{ Auth::user()->nomor_telepon ?? '-' }}</div>
            </div>

            <div class="col-12">
              <label class="form-label fw-semibold text-muted small">Program Studi</label>
              <div class="form-control-plaintext fw-bold">{{ Auth::user()->prodi ?? '-' }}</div>
            </div>
          </div>
          @endauth

          @auth('admin')
          <!-- ADMIN FIELDS -->
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label fw-semibold text-muted small">Nama Lengkap</label>
              <div class="form-control-plaintext fw-bold">{{ Auth::guard('admin')->user()->nama ?? 'Administrator Utama' }}</div>
            </div>
            
            <div class="col-md-6">
              <label class="form-label fw-semibold text-muted small">Email</label>
              <div class="form-control-plaintext fw-bold">{{ Auth::guard('admin')->user()->email ?? 'admin@ftmm.unair.ac.id' }}</div>
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
              <label class="form-label fw-semibold text-muted small">Jabatan</label>
              <div class="form-control-plaintext fw-bold">{{ Auth::guard('admin')->user()->jabatan ?? 'Administrator Sistem' }}</div>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold text-muted small">Role</label>
              <div class="form-control-plaintext">
                <span class="badge" style="background: linear-gradient(135deg, #6B21A8, #0ea5f0);">Super Administrator</span>
              </div>
            </div>
          </div>
          @endauth

        </div>
      </div>

      <!-- Change Password - COLLAPSIBLE -->
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

            @auth('web')
            <form action="{{ route('profil.password') }}" method="POST">
            @endauth
            @auth('admin')
            <form action="{{ route('admin.profil.password') }}" method="POST">
            @endauth
              @csrf
              @method('PUT')

              <div class="mb-3">
                <label class="form-label fw-semibold">Password Lama <span class="text-danger">*</span></label>
                <input type="password" name="old_password" class="form-control form-control-lg" placeholder="Masukkan password lama" required>
              </div>

              <div class="mb-3">
                <label class="form-label fw-semibold">Password Baru <span class="text-danger">*</span></label>
                <input type="password" name="new_password" class="form-control form-control-lg" placeholder="Min. 6 karakter" required>
                <small class="text-muted">Minimal 6 karakter, gunakan kombinasi huruf dan angka</small>
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

#passwordForm {
  animation: slideDown 0.3s ease-out;
}

@keyframes slideDown {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endsection