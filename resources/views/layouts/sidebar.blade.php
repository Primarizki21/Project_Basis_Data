<div class="sidebar w-[280px] min-h-screen fixed top-0 left-0 shadow-xl z-[1000] bg-gradient-to-b from-primary via-[#7C3AED] to-secondary transition-transform duration-300 lg:translate-x-0 overflow-y-auto">
  
  <!-- User Profile -->
  <div class="p-4 border-b border-white/25">
    <div class="flex items-center text-white">
      <div class="w-[55px] h-[55px] rounded-[15px] bg-white/20 flex items-center justify-center text-2xl font-bold mr-4 shadow-sm backdrop-blur-sm">
        @auth('web')
          {{ strtoupper(substr(Auth::user()->nama ?? 'U', 0, 1)) }}
        @endauth
        @auth('admin')
          {{ strtoupper(substr(Auth::guard('admin')->user()->nama ?? 'A', 0, 1)) }}
        @endauth
      </div>
      <div class="flex-1 min-w-0">
        <div class="font-bold truncate text-lg">
          @auth('web')
            {{ Str::limit(Auth::user()->nama ?? 'User', 15) }}
          @endauth
          @auth('admin')
            {{ Str::limit(Auth::guard('admin')->user()->nama ?? 'Admin', 15) }}
          @endauth
        </div>
        <small class="opacity-75 truncate block text-xs">
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
  <nav class="p-3" style="min-height: calc(100vh - 150px);">
    <div class="mb-2 mt-2">
      <small class="text-white/50 px-3 font-semibold text-[0.7rem] uppercase tracking-wider">Menu</small>
    </div>

    @auth('web')
      <!-- Menu untuk User Biasa (Mahasiswa/Staff) -->
      <a href="{{ route('beranda') }}" class="sidebar-link {{ request()->routeIs('beranda') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
        </svg>
        <span>Dashboard</span>
      </a>

      <a href="{{ route('pengaduan.create') }}" class="sidebar-link {{ request()->routeIs('pengaduan.create') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>Buat Pengaduan</span>
      </a>

      <a href="{{ route('riwayat') }}" class="sidebar-link {{ request()->routeIs('riwayat') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>Riwayat Pengaduan</span>
      </a>

      <a href="{{ route('profil') }}" class="sidebar-link {{ request()->routeIs('profil') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
        </svg>
        <span>Profil Saya</span>
      </a>
    @endauth

    @auth('admin')
      <!-- Menu untuk Admin -->
      <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" />
        </svg>
        <span>Dashboard</span>
      </a>

      <a href="{{ route('admin.kelola-pengaduan') }}" class="sidebar-link {{ request()->routeIs('admin.kelola-pengaduan') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
          <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
        </svg>
        <span>Kelola Pengaduan</span>
      </a>

      <a href="{{ route('admin.visualisasi') }}" class="sidebar-link {{ request()->routeIs('admin.visualisasi') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
        </svg>
        <span>Visualisasi Data</span>
      </a>

      <div class="mb-2 mt-3">
        <small class="text-white/50 px-3 font-semibold text-[0.7rem] uppercase tracking-wider">Pengaturan</small>
      </div>

      <a href="{{ route('admin.kelola-user') }}" class="sidebar-link {{ request()->routeIs('admin.kelola-user') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
        </svg>
        <span>Kelola User</span>
      </a>

      <a href="{{ route('admin.profil') }}" class="sidebar-link {{ request()->routeIs('admin.profil') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
          <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.95 1.109v1.094c-.01.548-.407 1.018-.95 1.109l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.149-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z" />
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        <span>Profil</span>
      </a>
    @endauth

    <!-- Logout - OUTSIDE auth blocks -->
    <div class="border-t border-white/25 mt-3 pt-3">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="sidebar-link w-full text-left bg-red-500/15 hover:bg-red-500/30">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
          </svg>
          <span>Keluar</span>
        </button>
      </form>
    </div>
  </nav>

  <!-- Footer Info -->
  <div class="p-3 border-t border-white/25 absolute bottom-0 w-full bg-black/10">
    <div class="text-white text-center opacity-75 text-xs">
      <p class="mb-0">© 2025 VOIZ FTMM</p>
    </div>
  </div>
</div>

<style>
/* Custom Utility Class for Sidebar Link */
@layer components {
    .sidebar-link {
        @apply flex items-center px-4 py-3 mb-1.5 rounded-lg text-white no-underline transition-all duration-300 ease-[cubic-bezier(0.4,0,0.2,1)] text-[0.95rem] relative overflow-hidden hover:bg-white/15 hover:text-white hover:translate-x-[5px];
    }

    .sidebar-link svg {
        @apply transition-transform duration-300;
    }

    .sidebar-link:hover svg {
        @apply scale-110;
    }

    .sidebar-link.active {
        @apply bg-white/25 font-semibold text-white shadow-lg;
    }

    .sidebar-link.active::before {
        content: '';
        @apply absolute left-0 top-1/2 -translate-y-1/2 w-1 h-[70%] bg-[#fbbf24] rounded-r-md;
    }
}

/* Custom Scrollbar for Sidebar */
.sidebar nav::-webkit-scrollbar {
    width: 6px;
}
.sidebar nav::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.05);
}
.sidebar nav::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 3px;
}
.sidebar nav::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.3);
}
</style>
