@extends('layouts.app')

@section('content')
<div class="min-vh-100 d-flex align-items-center" style="background: linear-gradient(135deg, #6B21A8 0%, #7C3AED 50%, #0ea5f0 100%);">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <!-- Card Login -->
        <div class="card border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
          <!-- Header -->
          <div class="card-header bg-white border-0 text-center p-4">
            <div class="mb-3">
              <div class="mx-auto" style="width:80px;height:80px;border-radius:20px;background:linear-gradient(135deg,#6B21A8,#0ea5f0);display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:2.5rem;box-shadow: 0 10px 30px rgba(107, 33, 168, 0.3);">V</div>
            </div>
            <h3 class="fw-bold mb-1">Masuk ke VOIZ FTMM</h3>
            <p class="text-muted mb-0">Sistem Pengaduan Online</p>
          </div>

          <!-- Body -->
          <div class="card-body p-4">
            <form method="POST" action="{{ route('login') }}">
              @csrf

              <!-- Email -->
              <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <div class="input-group input-group-lg">
                  <span class="input-group-text bg-light border-end-0">
                    <i class="bi bi-envelope"></i>
                  </span>
                  <input type="email" name="email" class="form-control border-start-0 @error('email') is-invalid @enderror" placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
                </div>
                @error('email')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <!-- Password -->
              <div class="mb-3">
                <label class="form-label fw-semibold">Password</label>
                <div class="input-group input-group-lg">
                  <span class="input-group-text bg-light border-end-0">
                    <i class="bi bi-lock"></i>
                  </span>
                  <input type="password" name="password" class="form-control border-start-0 @error('password') is-invalid @enderror" placeholder="Masukkan password" required>
                </div>
                @error('password')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <!-- Remember Me -->
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">
                  Ingat saya
                </label>
              </div>

              <!-- Submit Button -->
              <button type="submit" class="btn btn-lg w-100 text-white mb-3" style="background: linear-gradient(135deg, #6B21A8, #0ea5f0); border: none; border-radius: 10px; box-shadow: 0 4px 15px rgba(107, 33, 168, 0.3);">
                <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
              </button>

              <!-- Forgot Password -->
              @if (Route::has('password.request'))
              <div class="text-center mb-3">
                <a href="{{ route('password.request') }}" class="text-decoration-none">Lupa password?</a>
              </div>
              @endif

              <!-- Divider -->
              <div class="text-center text-muted my-3">
                <small>Belum punya akun?</small>
              </div>

              <!-- Register Link -->
              <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg w-100" style="border-radius: 10px; border-width: 2px;">
                Daftar Sekarang
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

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endsection