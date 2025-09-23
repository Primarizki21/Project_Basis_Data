<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>VOIZ - E-Complaint FTMM</title>

  <!-- Tailwind CDN for styling (no build step) -->
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    /* Palette: blue -> teal (tosca) */
    :root{
      --bg:#f6fbfd;
      --card:#ffffff;
      --muted:#6b7280;
      --accent-1:#0ea5a9; /* tosca */
      --accent-2:#0ea5f0; /* blue */
      --shadow: 0 10px 30px rgba(2,6,23,0.06);
    }
    body { background: var(--bg); }
    .card { background: var(--card); border-radius: 14px; box-shadow: var(--shadow); }
    .navbar { transition: background .25s ease, transform .18s ease, box-shadow .18s ease; backdrop-filter: blur(6px); }
    .navbar.scrolled { background: rgba(255,255,255,0.95); box-shadow: 0 8px 30px rgba(2,6,23,0.06); }
    .toast { position: fixed; right: 20px; top: 20px; z-index: 60; padding: 12px 16px; border-radius: 10px; color:white; font-weight:700; box-shadow:0 12px 30px rgba(2,6,23,0.12); }
  </style>
</head>
<body class="antialiased">

{{-- hide navbar on auth pages (login/register/forgot) --}}
@if (!Request::is('login') && !Request::is('register') && !Request::is('forgot'))
  <header id="navbar" class="navbar fixed w-full z-40">
    <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
      <a href="{{ route('beranda') }}" class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-100 to-teal-100 flex items-center justify-center text-teal-700 font-bold">V</div>
        <div class="font-extrabold text-teal-700">VOIZ</div>
      </a>
      <nav class="hidden md:flex gap-6 text-sm text-gray-700">
        <a href="{{ route('beranda') }}" class="hover:text-teal-600">Beranda</a>
        <a href="{{ route('profil') }}" class="hover:text-teal-600">Profil</a>
        <a href="{{ route('riwayat.index') }}" class="hover:text-teal-600">Riwayat</a>
        <a href="{{ route('kontak') }}" class="hover:text-teal-600">Kontak</a>
      </nav>

      <div class="flex items-center gap-3">
        @auth
          <div class="text-sm text-gray-700 text-right">
            <div class="font-semibold">{{ Auth::user()->nama }}</div>
            <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
          </div>
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="ml-3 px-3 py-2 rounded-md bg-white text-teal-600 font-semibold">Logout</button>
          </form>
        @else
          <a href="{{ route('login.form') }}" class="ml-3 px-3 py-2 rounded-md text-sm text-teal-600">Login</a>
        @endauth
      </div>
    </div>
  </header>
  <div class="h-16"></div>
@endif

  <main class="max-w-6xl mx-auto px-4 py-6">
    @yield('content')
  </main>

  <footer class="mt-8 text-center text-sm text-gray-500 py-6">© {{ date('Y') }} VOIZ — Fakultas Teknologi Maju & Multidisiplin</footer>

  {{-- Toast messages --}}
  @if(session('success'))
    <div class="toast bg-teal-500">{{ session('success') }}</div>
  @endif
  @if(session('error') || $errors->any())
    <div class="toast bg-rose-500">@if(session('error')){{ session('error') }}@else{{ $errors->first() }}@endif</div>
  @endif

  <script>
    // navbar scroll effect
    const nav = document.getElementById('navbar');
    if(nav){
      window.addEventListener('scroll', ()=> {
        if(window.scrollY > 16) nav.classList.add('scrolled');
        else nav.classList.remove('scrolled');
      });
    }
    // hide toasts after 4s
    setTimeout(()=> document.querySelectorAll('.toast').forEach(t => t.style.display='none'), 4000);
  </script>
</body>
</html>