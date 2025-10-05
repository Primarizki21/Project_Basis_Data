@extends('layouts.app')

@section('content')
<div class="min-vh-100 d-flex align-items-center py-5" style="background: linear-gradient(135deg, #6B21A8 0%, #7C3AED 50%, #0ea5f0 100%);">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-7 col-lg-6">
        <!-- Card Register -->
        <div class="card border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
          <!-- Header -->
          <div class="card-header bg-white border-0 text-center p-4">
            <div class="mb-3">
              <div class="mx-auto" style="width:80px;height:80px;border-radius:20px;background:linear-gradient(135deg,#6B21A8,#0ea5f0);display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:2.5rem;box-shadow: 0 10px 30px rgba(107, 33, 168, 0.3);">V</div>
            </div>
            <h3 class="fw-bold mb-1">Daftar Akun Baru</h3>
            <p class="text-muted mb-0">Buat akun untuk mulai mengajukan pengaduan</p>
          </div>

          <!-- Body -->
          <div class="card-body p-4">
            <form method="POST" action="{{ route('register') }}">
              @csrf

              <!-- Nama -->
              <div class="mb-3">
                <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" name="nama" class="form-control form-control-lg @error('nama') is-invalid @enderror" placeholder="Masukkan nama lengkap" value="{{ old('nama') }}" required>
                @error('nama')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <!-- Email -->
              <div class="mb-3">
                <label class="form-label fw-semibold">Email FTMM <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="nama@ftmm.unair.ac.id" value="{{ old('email') }}" required>
                <small class="text-muted">Harus menggunakan email @ftmm.unair.ac.id</small>
                @error('email')
                  <small class="text-danger d-block">{{ $message }}</small>
                @enderror
              </div>

              <!-- NIM -->
              <div class="mb-3">
                <label class="form-label fw-semibold">NIM <span class="text-danger">*</span></label>
                <input type="text" name="nim" class="form-control form-control-lg @error('nim') is-invalid @enderror" placeholder="Masukkan NIM" value="{{ old('nim') }}" required>
                @error('nim')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <!-- Jenis Kelamin -->
              <div class="mb-3">
                <label class="form-label fw-semibold">Jenis Kelamin <span class="text-danger">*</span></label>
                <select name="jenis_kelamin" class="form-select form-select-lg @error('jenis_kelamin') is-invalid @enderror" required>
                  <option value="">-- Pilih Jenis Kelamin --</option>
                  <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                  <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <div class="row">
                <div class="col-md-6">
                  <!-- Tempat Lahir -->
                  <div class="mb-3">
                    <label class="form-label fw-semibold">Tempat Lahir <span class="text-danger">*</span></label>
                    <input type="text" name="tempat_lahir" class="form-control form-control-lg @error('tempat_lahir') is-invalid @enderror" placeholder="Surabaya" value="{{ old('tempat_lahir') }}" required>
                    @error('tempat_lahir')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <!-- Tanggal Lahir -->
                  <div class="mb-3">
                    <label class="form-label fw-semibold">Tanggal Lahir <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_lahir" class="form-control form-control-lg @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir') }}" required>
                    @error('tanggal_lahir')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                </div>
              </div>

              <!-- Alamat -->
              <div class="mb-3">
                <label class="form-label fw-semibold">Alamat <span class="text-danger">*</span></label>
                <textarea name="alamat" rows="2" class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat lengkap" required>{{ old('alamat') }}</textarea>
                @error('alamat')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <!-- Nomor Telepon -->
              <div class="mb-3">
                <label class="form-label fw-semibold">Nomor Telepon <span class="text-danger">*</span></label>
                <input type="tel" name="nomor_telepon" class="form-control form-control-lg @error('nomor_telepon') is-invalid @enderror" placeholder="08xxxxxxxxxx" value="{{ old('nomor_telepon') }}" required>
                @error('nomor_telepon')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <!-- Jenis Pekerjaan -->
              <div class="mb-3">
                <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                <select name="jenis_pekerjaan_id" id="jenisPekerjaanSelect" class="form-select form-select-lg @error('jenis_pekerjaan_id') is-invalid @enderror" required>
                  <option value="">-- Pilih Status --</option>
                  @foreach($listPekerjaan as $pekerjaan)
                    <option value="{{ $pekerjaan->jenis_pekerjaan_id }}" {{ old('jenis_pekerjaan_id') == $pekerjaan->jenis_pekerjaan_id ? 'selected' : '' }}>
                      {{ $pekerjaan->jenis_pekerjaan }}
                    </option>
                  @endforeach
                </select>
                @error('jenis_pekerjaan_id')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <!-- Prodi (Show if Mahasiswa) -->
              <div class="mb-3" id="prodiField" style="display: none;">
                <label class="form-label fw-semibold">Program Studi <span class="text-danger">*</span></label>
                <select name="prodi" class="form-select form-select-lg @error('prodi') is-invalid @enderror">
                  <option value="">-- Pilih Program Studi --</option>
                  @foreach($listProdi as $prodi)
                    <option value="{{ $prodi->nama_prodi }}" {{ old('prodi') == $prodi->nama_prodi ? 'selected' : '' }}>
                      {{ $prodi->nama_prodi }}
                    </option>
                  @endforeach
                </select>
                @error('prodi')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <!-- Angkatan (Show if Mahasiswa) -->
              <div class="mb-3" id="angkatanField" style="display: none;">
                <label class="form-label fw-semibold">Angkatan <span class="text-danger">*</span></label>
                <input type="text" name="angkatan" class="form-control form-control-lg @error('angkatan') is-invalid @enderror" placeholder="Contoh: 2023" value="{{ old('angkatan') }}" maxlength="4">
                @error('angkatan')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <!-- Password -->
              <div class="mb-3">
                <label class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
                <input type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Minimal 6 karakter" required>
                @error('password')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <!-- Confirm Password -->
              <div class="mb-3">
                <label class="form-label fw-semibold">Konfirmasi Password <span class="text-danger">*</span></label>
                <input type="password" name="password_confirmation" class="form-control form-control-lg" placeholder="Ulangi password" required>
              </div>

              <!-- Agreement -->
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="agreement" required>
                <label class="form-check-label" for="agreement">
                  Saya setuju dengan <a href="#" class="text-decoration-none">Syarat & Ketentuan</a>
                </label>
              </div>

              <!-- Submit Button -->
              <button type="submit" class="btn btn-lg w-100 text-white mb-3" style="background: linear-gradient(135deg, #6B21A8, #0ea5f0); border: none; border-radius: 10px; box-shadow: 0 4px 15px rgba(107, 33, 168, 0.3);">
                <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
              </button>

              <!-- Divider -->
              <div class="text-center text-muted my-3">
                <small>Sudah punya akun?</small>
              </div>

              <!-- Login Link -->
              <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg w-100" style="border-radius: 10px; border-width: 2px;">
                Masuk
              </a>
            </form>
          </div>

          <!-- Footer -->
          <div class="card-footer bg-light border-0 text-center p-3">
            <small class="text-muted">© 2025 VOIZ FTMM - UNAIR</small>
          </div>
        </div>

        <!-- Back to Home -->
        <div class="text-center mt-3">
          <a href="{{ url('/') }}" class="text-white text-decoration-none">
            <i class="bi bi-arrow-left me-2"></i>Kembali ke Beranda
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
// Show/hide prodi & angkatan fields based on jenis pekerjaan
document.getElementById('jenisPekerjaanSelect').addEventListener('change', function() {
  const prodiField = document.getElementById('prodiField');
  const angkatanField = document.getElementById('angkatanField');
  const prodiSelect = prodiField.querySelector('select');
  const angkatanInput = angkatanField.querySelector('input');
  
  if (this.value == '1') { // ID 1 biasanya Mahasiswa
    prodiField.style.display = 'block';
    angkatanField.style.display = 'block';
    prodiSelect.required = true;
    angkatanInput.required = true;
  } else {
    prodiField.style.display = 'none';
    angkatanField.style.display = 'none';
    prodiSelect.required = false;
    angkatanInput.required = false;
    prodiSelect.value = '';
    angkatanInput.value = '';
  }
});

// Trigger on page load if old value exists
window.addEventListener('DOMContentLoaded', function() {
  const select = document.getElementById('jenisPekerjaanSelect');
  if (select.value) {
    select.dispatchEvent(new Event('change'));
  }
});
</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endsection