<div class="sidebar" style="width: 280px; min-height: 100vh; background: linear-gradient(180deg, #6B21A8 0%, #7C3AED 50%, #0ea5f0 100%); position: fixed; top: 0; left: 0; box-shadow: 2px 0 15px rgba(0,0,0,0.1); z-index: 1000;">
  
  <!-- User Profile -->
  <div class="p-4 border-bottom border-white border-opacity-25">
    <div class="d-flex align-items-center text-white">
      <div style="width:55px;height:55px;border-radius:15px;background:rgba(255,255,255,0.2);display:flex;align-items:center;justify-content:center;font-size:1.8rem;font-weight:700;margin-right:15px;box-shadow:0 4px 10px rgba(0,0,0,0.1);">
        @auth('web')
          {{ strtoupper(substr(Auth::user()->nama ?? 'U', 0, 1)) }}
        @endauth
        @auth('admin')
          {{ strtoupper(substr(Auth::guard('admin')->user()->nama ?? 'A', 0, 1)) }}
        @endauth
      </div>
      <div style="flex:1;min-width:0;">
        <div class="fw-bold text-truncate" style="font-size: 1.1rem;">
          @auth('web')
            {{ Str::limit(Auth::user()->nama ?? 'User', 15) }}
          @endauth
          @auth('admin')
            {{ Str::limit(Auth::guard('admin')->user()->nama ?? 'Admin', 15) }}
          @endauth
        </div>
        <small class="opacity-75 text-truncate d-block" style="font-size: 0.8rem;">
          @auth('web')
            Mahasiswa
          @endauth
          @auth('admin')
            Administrator
          @endauth
        </small>
      </div>
    </div>
  </div>

  <!-- Navigation Menu -->
  <nav class="p-3" style="height: calc(100vh - 150px); overflow-y: auto;">
    <div class="mb-2 mt-2">
      <small class="text-white opacity-50 px-3 fw-semibold" style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px;">Menu</small>
    </div>

    @auth('web')
      <!-- Menu untuk User Biasa (Mahasiswa/Staff) -->
      <a href="{{ route('beranda') }}" class="sidebar-link {{ request()->routeIs('beranda') ? 'active' : '' }}">
        <i class="bi bi-house-door"></i>
        <span>Dashboard</span>
      </a>

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

      <a href="{{ route('admin.kelola-pengaduan') }}" class="sidebar-link {{ request()->routeIs('admin.kelola-pengaduan') ? 'active' : '' }}">
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

      <a href="{{ route('admin.kelola-user') }}" class="sidebar-link {{ request()->routeIs('admin.kelola-user') ? 'active' : '' }}">
        <i class="bi bi-people"></i>
        <span>Kelola User</span>
      </a>

      <a href="{{ route('admin.profil') }}" class="sidebar-link {{ request()->routeIs('admin.profil') ? 'active' : '' }}">
        <i class="bi bi-person-gear"></i>
        <span>Profil</span>
      </a>
    @endauth

    <!-- Logout - OUTSIDE auth blocks -->
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
  <div class="p-3 border-top border-white border-opacity-25" style="position: absolute; bottom: 0; width: 100%; background: rgba(0,0,0,0.1);">
    <div class="text-white text-center opacity-75" style="font-size: 0.7rem;">
      <p class="mb-0">© 2025 VOIZ FTMM</p>
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
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  font-size: 0.95rem;
  position: relative;
  overflow: hidden;
}

.sidebar-link i {
  font-size: 1.2rem;
  margin-right: 12px;
  width: 24px;
  text-align: center;
  transition: transform 0.3s ease;
}

.sidebar-link:hover {
  background: rgba(255, 255, 255, 0.15);
  color: white;
  transform: translateX(5px);
}

.sidebar-link:hover i {
  transform: scale(1.1);
}

.sidebar-link.active {
  background: rgba(255, 255, 255, 0.25);
  font-weight: 600;
  color: white;
  box-shadow: 0 4px 15px rgba(0,0,0,0.15);
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
  background: rgba(239, 68, 68, 0.15);
}

.logout-btn:hover {
  background: rgba(239, 68, 68, 0.3);
  transform: translateX(5px);
}

nav::-webkit-scrollbar {
  width: 6px;
}

nav::-webkit-scrollbar-track {
  background: rgba(255, 255, 255, 0.05);
}

nav::-webkit-scrollbar-thumb {
  background: rgba(255, 255, 255, 0.2);
  border-radius: 3px;
}

nav::-webkit-scrollbar-thumb:hover {
  background: rgba(255, 255, 255, 0.3);
}
</style>