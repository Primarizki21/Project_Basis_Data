<!DOCTYPE html>
<html>
<head>
    <title>Sistem Pengajuan Kekerasan Perempuan</title>
</head>
<body>
    <header>
        <h2>Aplikasi Pengajuan Kekerasan Terhadap Perempuan</h2>
        <nav>
            <a href="{{ route('index') }}">Home</a>
            @guest
                <a href="{{ route('login') }}">Register/Login</a>
            @else
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @endguest
        </nav>
    </header>
    <hr>

    <main>
        @yield('content')
    </main>

    <hr>
    <footer>
        <p>&copy; 2025 - Fakultas Teknologi Maju dan Multidisiplin</p>
    </footer>
</body>
</html>
