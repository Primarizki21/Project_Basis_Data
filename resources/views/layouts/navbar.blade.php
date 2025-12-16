<nav class="sticky top-0 bg-white/95 backdrop-blur-md shadow-[0_2px_20px_rgba(0,0,0,0.08)] z-40">
  <div class="container mx-auto px-4 lg:px-8">
    <div class="flex items-center justify-between h-20">
      <!-- Logo & Brand -->
      <a class="flex items-center font-bold text-gray-800 hover:opacity-80 transition-opacity" href="/">
        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary to-secondary flex items-center justify-center text-white font-bold mr-3 shadow-lg shadow-primary/30">V</div>
        <span class="bg-gradient-to-br from-primary to-secondary bg-clip-text text-transparent text-xl">VOIZ FTMM</span>
      </a>

      <!-- Mobile Toggle -->
      <button id="mobile-menu-btn" class="lg:hidden p-2 text-gray-600 hover:text-primary transition-colors focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
      </button>

      <!-- Menu Items -->
      <div class="hidden lg:flex items-center space-x-2" id="desktop-menu">
        <ul class="flex items-center space-x-2 mb-0 pl-0 list-none">
          @guest
            <!-- Menu untuk Guest (Belum Login) -->
            <li>
              <a class="nav-link-hover font-semibold px-3 py-2 text-gray-600 hover:text-primary transition-colors block" href="/">Beranda</a>
            </li>
            <li>
              <a class="nav-link-hover font-semibold px-3 py-2 text-gray-600 hover:text-primary transition-colors block" href="/#jenis-pengaduan">Jenis Pengaduan</a>
            </li>
            <li>
              <a class="nav-link-hover font-semibold px-3 py-2 text-gray-600 hover:text-primary transition-colors block" href="/#alur">Alur</a>
            </li>
            <li>
              <a class="nav-link-hover font-semibold px-3 py-2 text-gray-600 hover:text-primary transition-colors block" href="/#kontak">Kontak</a>
            </li>

            <!-- Auth Buttons -->
            <li class="ml-2">
              <a class="inline-flex items-center justify-center px-6 py-2 border-2 border-primary text-primary font-semibold rounded-lg hover:bg-gradient-to-br hover:from-primary hover:to-secondary hover:text-white hover:border-transparent hover:-translate-y-0.5 hover:shadow-lg hover:shadow-primary/30 transition-all duration-300" href="{{ route('login') }}">
                Masuk
              </a>
            </li>
            <li class="ml-2">
              <a class="inline-flex items-center justify-center px-6 py-2 bg-gradient-to-br from-primary to-secondary text-white font-semibold rounded-lg shadow-lg shadow-primary/30 hover:opacity-90 hover:-translate-y-0.5 transition-all duration-300" href="{{ route('register') }}">
                Daftar
              </a>
            </li>
          @else
            <!-- Menu untuk User yang Sudah Login (Profile Dropdown) -->
            <li class="relative group">
              <button id="user-menu-btn" class="flex items-center space-x-3 px-4 py-2 rounded-xl hover:bg-gray-50 transition-colors focus:outline-none">
                <div class="w-[35px] h-[35px] rounded-lg bg-gradient-to-br from-primary to-secondary flex items-center justify-center text-white font-semibold text-sm">
                  {{ strtoupper(substr(Auth::user()->nama ?? Auth::guard('admin')->user()->nama ?? 'U', 0, 1)) }}
                </div>
                <span class="font-semibold text-gray-700 max-w-[150px] truncate">
                    {{ Str::limit(Auth::user()->nama ?? Auth::guard('admin')->user()->nama ?? 'User', 20) }}
                </span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
              </button>

              <!-- Dropdown Menu -->
              <div id="user-dropdown" class="absolute right-0 top-full mt-2 w-56 bg-white rounded-xl shadow-xl border border-gray-100 hidden opacity-0 translate-y-2 transition-all duration-200 z-50">
                <div class="px-4 py-3 border-b border-gray-100">
                  <small class="text-gray-500 block text-xs uppercase tracking-wider mb-1">Signed in as</small>
                  <strong class="block text-gray-900 truncate">{{ Auth::user()->nama ?? Auth::guard('admin')->user()->nama ?? 'User' }}</strong>
                </div>
                <div class="py-1">
                  <a href="{{ route('profil') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2.5 text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                    Profil Saya
                  </a>
                  <a href="{{ route('beranda') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2.5 text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                    </svg>
                    Dashboard
                  </a>
                </div>
                <div class="border-t border-gray-100 py-1">
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full flex items-center px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors text-left">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                        </svg>
                        Keluar
                    </button>
                  </form>
                </div>
              </div>
            </li>
          @endguest
        </ul>
      </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden lg:hidden border-t border-gray-100 bg-white absolute left-0 right-0 shadow-lg p-4">
        <ul class="flex flex-col space-y-2 list-none pl-0 mb-0">
             @guest
                <li><a class="block px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-primary rounded-lg font-semibold" href="/">Beranda</a></li>
                <li><a class="block px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-primary rounded-lg font-semibold" href="/#jenis-pengaduan">Jenis Pengaduan</a></li>
                <li><a class="block px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-primary rounded-lg font-semibold" href="/#alur">Alur</a></li>
                <li><a class="block px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-primary rounded-lg font-semibold" href="/#kontak">Kontak</a></li>
                <li class="pt-2 flex flex-col space-y-2">
                    <a class="text-center px-6 py-2 border-2 border-primary text-primary font-semibold rounded-lg hover:bg-primary hover:text-white" href="{{ route('login') }}">Masuk</a>
                    <a class="text-center px-6 py-2 bg-gradient-to-br from-primary to-secondary text-white font-semibold rounded-lg" href="{{ route('register') }}">Daftar</a>
                </li>
             @else
                <li class="px-4 py-2 border-b border-gray-100 mb-2">
                    <div class="flex items-center space-x-3">
                         <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-primary to-secondary flex items-center justify-center text-white font-semibold text-xs">
                             {{ strtoupper(substr(Auth::user()->nama ?? Auth::guard('admin')->user()->nama ?? 'U', 0, 1)) }}
                         </div>
                         <div>
                             <p class="font-semibold text-gray-900 text-sm">{{ Str::limit(Auth::user()->nama ?? Auth::guard('admin')->user()->nama ?? 'User', 20) }}</p>
                             <p class="text-xs text-gray-500">Logged in</p>
                         </div>
                    </div>
                </li>
                <li>
                    <a class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-50 rounded-lg" href="{{ route('profil') }}">
                        <span class="mr-3">👤</span> Profil Saya
                    </a>
                </li>
                <li>
                    <a class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-50 rounded-lg" href="{{ route('beranda') }}">
                        <span class="mr-3">📊</span> Dashboard
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="w-full flex items-center px-4 py-2 text-red-600 hover:bg-red-50 rounded-lg text-left">
                            <span class="mr-3">🚪</span> Keluar
                        </button>
                    </form>
                </li>
             @endguest
        </ul>
    </div>
  </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Dropdown Logic
        const userMenuBtn = document.getElementById('user-menu-btn');
        const userDropdown = document.getElementById('user-dropdown');

        if (userMenuBtn && userDropdown) {
            let isOpen = false;

            userMenuBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                isOpen = !isOpen;
                if (isOpen) {
                    userDropdown.classList.remove('hidden');
                    // Small timeout to allow transition
                    setTimeout(() => {
                        userDropdown.classList.remove('opacity-0', 'translate-y-2');
                    }, 10);
                } else {
                    userDropdown.classList.add('opacity-0', 'translate-y-2');
                    setTimeout(() => {
                        userDropdown.classList.add('hidden');
                    }, 200);
                }
            });

            // Close when clicking outside
            document.addEventListener('click', (e) => {
                if (!userMenuBtn.contains(e.target) && !userDropdown.contains(e.target) && isOpen) {
                    isOpen = false;
                    userDropdown.classList.add('opacity-0', 'translate-y-2');
                    setTimeout(() => {
                        userDropdown.classList.add('hidden');
                    }, 200);
                }
            });
        }

        // Mobile Menu Logic
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }
    });
</script>

<style>
/* Custom Navbar Styles */
.nav-link-hover {
  position: relative;
}

.nav-link-hover::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 50%;
  width: 0;
  height: 2px;
  @apply bg-gradient-to-r from-primary to-secondary;
  transition: all 0.3s ease;
  transform: translateX(-50%);
}

.nav-link-hover:hover::after {
  width: 80%;
}
</style>
