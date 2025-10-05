<div class="sidebar" style="width: 280px; min-height: 100vh; background: linear-gradient(180deg, #6B21A8 0%, #7C3AED 50%, #0ea5f0 100%); position: sticky; top: 0; box-shadow: 2px 0 15px rgba(0,0,0,0.1);">
  <!-- Logo & Brand -->
  <div class="p-4 border-bottom border-white border-opacity-25">
    <div class="d-flex align-items-center text-white">
      <div style="width:45px;height:45px;border-radius:12px;background:rgba(255,255,255,0.2);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:1.5rem;margin-right:12px;">V</div>
      <div>
        <div class="fw-bold" style="font-size: 1.1rem;">VOIZ FTMM</div>
        <small class="opacity-75" style="font-size: 0.75rem;">Sistem Pengaduan</small>
      </div>
    </div>
  </div>

  <!-- User Profile -->
  <div class="p-4 border-bottom border-white border-opacity-25">
    <div class="d-flex align-items-center text-white">
      <div style="width:50px;height:50px;border-radius:12px;background:rgba(255,255,255,0.2);display:flex;align-items:center;justify-content:center;font-size:1.5rem;font-weight:600;margin-right:12px;">
        {{ strtoupper(substr(Auth::user()->nama ?? Auth::guard('admin')->user()->nama ?? 'U', 0, 1)) }}
      </div>
      <div style="flex:1;min-width:0;">
        <div class="fw-semibold text-truncate">{{ Auth::user()->nama ?? Auth::guard('admin')->user()->nama ?? 'User' }}</div>
        <small class="opacity-75 text-truncate d-block" style="font-size: 0.75rem;">{{ Auth::user()->email ?? Auth::guard('admin')->user()->email ?? 'user@mail.com' }}</small>
      </div>
    </div>
  </div>

  <!-- Navigation Menu -->
  <nav class="p-3">
    <div class="mb-2">
      <small class="text-white opacity-50 px-3 fw-semibold" style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px;">Menu Utama</small>
    </div>

    @auth
      <!-- Menu untuk User biasa -->
      <a href="{{ route('pengaduan.create') }}" class="sidebar-link {{ request()->routeIs('pengaduan.create') ? 'active' : '' }}">
        <i class="bi bi-plus-circle"></i>
        <span>Buat Pengaduan</span>
      </a>

      <a href="{{ route('riwayat') }}" class="sidebar-link {{ request()->routeIs('riwayat') ? 'active' : '' }}">
        <i class="bi bi-clock-history"></i>
        <span>Riwayat Pengaduan</span>
      </a>

      <a href="{{ route('profil') }}" class="sidebar-link {{ request()->routeIs('profil') ? 'active' : '' }}">
        <i class="bi bi-person"></i>
        <span>Profil Saya</span>
      </a>
    @endauth

    @auth('admin')
      <!-- Menu untuk Admin -->
      <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="bi bi-speedometer2"></i>
        <span>Dashboard</span>
      </a>

      <a href="{{ route('admin.pengaduan') }}" class="sidebar-link {{ request()->routeIs('admin.pengaduan') ? 'active' : '' }}">
        <i class="bi bi-inbox"></i>
        <span>Kelola Pengaduan</span>
      </a>

      <a href="{{ route('admin.visualisasi') }}" class="sidebar-link {{ request()->routeIs('admin.visualisasi') ? 'active' : '' }}">
        <i class="bi bi-bar-chart"></i>
        <span>Visualisasi Data</span>
      </a>

      <div class="mb-2 mt-3">
        <small class="text-white opacity-50 px-3 fw-semibold" style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px;">Pengaturan</small>
      </div>

      <a href="{{ route('admin.users') }}" class="sidebar-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
        <i class="bi bi-people"></i>
        <span>Kelola User</span>
      </a>

      <a href="{{ route('profil') }}" class="sidebar-link {{ request()->routeIs('profil') ? 'active' : '' }}">
        <i class="bi bi-person"></i>
        <span>Profil</span>
      </a>
    @endauth

    <!-- Logout -->
    <div class="border-top border-white border-opacity-25 mt-3 pt-3">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="sidebar-link logout-btn w-100 text-start border-0">
          <i class="bi bi-box-arrow-left"></i>
          <span>Keluar</span>
        </button>
      </form>
    </div>
  </nav>

  <!-- Footer Info -->
  <div class="mt-auto p-3" style="position: absolute; bottom: 0; width: 100%;">
    <div class="text-white text-center opacity-75" style="font-size: 0.7rem;">
      <p class="mb-1">© 2025 VOIZ FTMM</p>
      <p class="mb-0">UNAIR</p>
    </div>
  </div>
</div>

<style>
.sidebar-link {
  display: flex;
  align-items: center;
  padding: 12px 16px;
  margin-bottom: 6px;
  border-radius: 10px;
  color: white;
  text-decoration: none;
  transition: all 0.3s ease;
  font-size: 0.95rem;
  position: relative;
  overflow: hidden;
}

.sidebar-link i {
  font-size: 1.2rem;
  margin-right: 12px;
  width: 24px;
  text-align: center;
}

.sidebar-link:hover {
  background: rgba(255, 255, 255, 0.15);
  color: white;
  transform: translateX(5px);
}

.sidebar-link.active {
  background: rgba(255, 255, 255, 0.25);
  font-weight: 600;
  color: white;
  box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.sidebar-link.active::before {
  content: '';
  position: absolute;
  left: 0;
  top: 50%;
  transform: translateY(-50%);
  width: 4px;
  height: 70%;
  background: #fbbf24;
  border-radius: 0 4px 4px 0;
}

.logout-btn {
  background: rgba(239, 68, 68, 0.2);
}

.logout-btn:hover {
  background: rgba(239, 68, 68, 0.3);
  transform: translateX(5px);
}
</style>