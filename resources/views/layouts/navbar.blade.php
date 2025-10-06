<nav class="navbar navbar-expand-lg navbar-light sticky-top" style="background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); box-shadow: 0 2px 20px rgba(0,0,0,0.08);">
  <div class="container">
    <!-- Logo & Brand -->
    <a class="navbar-brand fw-bold text-dark d-flex align-items-center" href="/">
      <div style="width:40px;height:40px;border-radius:10px;background:linear-gradient(135deg,#6B21A8,#0ea5f0);display:flex;align-items:center;justify-content:center;color:white;font-weight:700;margin-right:12px;box-shadow: 0 4px 10px rgba(107, 33, 168, 0.3);">V</div>
      <span style="background: linear-gradient(135deg, #6B21A8, #0ea5f0); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-size: 1.2rem;">VOIZ FTMM</span>
    </a>

    <!-- Mobile Toggle -->
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu Items -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-center">
        @guest
          <!-- Menu untuk Guest (Belum Login) -->
          <li class="nav-item">
            <a class="nav-link fw-semibold px-3 nav-link-hover" href="/">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-semibold px-3 nav-link-hover" href="/#jenis-pengaduan">Jenis Pengaduan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-semibold px-3 nav-link-hover" href="/#alur">Alur</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-semibold px-3 nav-link-hover" href="/#kontak">Kontak</a>
          </li>
          
          <!-- Auth Buttons -->
          <li class="nav-item ms-2">
            <a class="btn btn-outline-primary px-4" href="{{ route('login') }}" style="border-radius: 8px; border-width: 2px;">
              Masuk
            </a>
          </li>
          <li class="nav-item ms-2">
            <a class="btn text-white px-4" href="{{ route('register') }}" style="background: linear-gradient(135deg, #6B21A8, #0ea5f0); border-radius: 8px; box-shadow: 0 4px 10px rgba(107, 33, 168, 0.3);">
              Daftar
            </a>
          </li>
        @else
          <!-- Menu untuk User yang Sudah Login (Only Profile Dropdown) -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center fw-semibold" href="#" role="button" data-bs-toggle="dropdown" style="padding: 8px 16px; border-radius: 10px; transition: all 0.3s ease;">
              <div style="width:35px;height:35px;border-radius:8px;background:linear-gradient(135deg,#6B21A8,#0ea5f0);display:flex;align-items:center;justify-content:center;color:white;font-weight:600;margin-right:10px;font-size:0.9rem;">
                {{ strtoupper(substr(Auth::user()->nama ?? Auth::guard('admin')->user()->nama ?? 'U', 0, 1)) }}
              </div>
              <span>{{ Str::limit(Auth::user()->nama ?? Auth::guard('admin')->user()->nama ?? 'User', 20) }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0" style="border-radius: 12px; min-width: 200px; margin-top: 10px;">
              <li class="px-3 py-2 border-bottom">
                <small class="text-muted d-block">Signed in as</small>
                <strong class="d-block">{{ Auth::user()->nama ?? Auth::guard('admin')->user()->nama ?? 'User' }}</strong>
              </li>
              <li>
                <a class="dropdown-item py-2" href="{{ route('profil') }}" style="border-radius: 8px;">
                  <i class="bi bi-person me-2"></i>Profil Saya
                </a>
              </li>
              <li>
                <a class="dropdown-item py-2" href="{{ route('beranda') }}" style="border-radius: 8px;">
                  <i class="bi bi-speedometer2 me-2"></i>Dashboard
                </a>
              </li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button class="dropdown-item py-2 text-danger" style="border-radius: 8px;">
                    <i class="bi bi-box-arrow-right me-2"></i>Keluar
                  </button>
                </form>
              </li>
            </ul>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>

<style>
.nav-link-hover {
  position: relative;
  transition: color 0.3s ease;
}

.nav-link-hover::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 50%;
  width: 0;
  height: 2px;
  background: linear-gradient(135deg, #6B21A8, #0ea5f0);
  transition: all 0.3s ease;
  transform: translateX(-50%);
}

.nav-link-hover:hover {
  color: #6B21A8!important;
}

.nav-link-hover:hover::after {
  width: 80%;
}

.btn-outline-primary {
  color: #6B21A8;
  border-color: #6B21A8;
  transition: all 0.3s ease;
}

.btn-outline-primary:hover {
  background: linear-gradient(135deg, #6B21A8, #0ea5f0);
  border-color: #6B21A8;
  color: white;
  transform: translateY(-2px);
  box-shadow: 0 4px 10px rgba(107, 33, 168, 0.3);
}

.dropdown-menu {
  animation: fadeInDown 0.3s ease;
}

@keyframes fadeInDown {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.dropdown-item:hover {
  background: #f3f4f6;
}

.nav-link.dropdown-toggle:hover {
  background: #f9fafb;
}
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">