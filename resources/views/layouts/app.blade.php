<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VOIZ FTMM</title>
    {{-- @vite(['resources/css/app.css','resources/js/app.js']) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">

    @guest
        @include('layouts.navbar')
        <main>
            @yield('content')
        </main>
    @else
        {{-- Sidebar --}}
        @include('layouts.sidebar')

        {{-- Main Content Area dengan Margin --}}
        <div id="main-content" style="margin-left: 280px; min-height: 100vh; transition: margin-left 0.3s ease;">
            {{-- Toggle Button untuk Mobile --}}
            <button id="sidebarToggle" class="btn btn-primary d-lg-none" style="position: fixed; top: 15px; left: 15px; z-index: 999; border-radius: 10px;">
                <i class="bi bi-list" style="font-size: 1.5rem;"></i>
            </button>

            <div class="p-4">
                @yield('content')
            </div>
        </div>
    @endguest

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    {{-- Sidebar Toggle Script --}}
    @auth
    <script>
        const sidebar = document.querySelector('.sidebar');
        const mainContent = document.getElementById('main-content');
        const toggleBtn = document.getElementById('sidebarToggle');
        let sidebarOpen = true;

        // Toggle Sidebar Function
        function toggleSidebar() {
            sidebarOpen = !sidebarOpen;
            
            if (sidebarOpen) {
                sidebar.style.left = '0';
                mainContent.style.marginLeft = '280px';
                toggleBtn.innerHTML = '<i class="bi bi-list" style="font-size: 1.5rem;"></i>';
            } else {
                sidebar.style.left = '-280px';
                mainContent.style.marginLeft = '0';
                toggleBtn.innerHTML = '<i class="bi bi-x-lg" style="font-size: 1.5rem;"></i>';
            }
        }

        // Event Listener
        if (toggleBtn) {
            toggleBtn.addEventListener('click', toggleSidebar);
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const isClickInsideSidebar = sidebar.contains(event.target);
            const isClickOnToggle = toggleBtn && toggleBtn.contains(event.target);
            const isMobile = window.innerWidth < 992;

            if (!isClickInsideSidebar && !isClickOnToggle && sidebarOpen && isMobile) {
                toggleSidebar();
            }
        });

        // Responsive behavior
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 992) {
                sidebar.style.left = '0';
                mainContent.style.marginLeft = '280px';
                sidebarOpen = true;
            }
        });

        // Initialize on mobile
        if (window.innerWidth < 992) {
            sidebar.style.left = '-280px';
            mainContent.style.marginLeft = '0';
            sidebarOpen = false;
            if (toggleBtn) {
                toggleBtn.innerHTML = '<i class="bi bi-x-lg" style="font-size: 1.5rem;"></i>';
            }
        }
    </script>
    @endauth
</body>
</html>