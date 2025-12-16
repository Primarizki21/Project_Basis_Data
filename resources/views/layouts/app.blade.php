<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VOIZ FTMM</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">

    @guest
        @include('layouts.navbar')
        <main>
            @yield('content')
        </main>
    @else
        {{-- Sidebar --}}
        @include('layouts.sidebar')

        {{-- Main Content Area --}}
        <div id="main-content" class="min-h-screen transition-all duration-300 lg:ml-[280px]">
            {{-- Toggle Button for Mobile --}}
            <button id="sidebarToggle" class="lg:hidden fixed top-4 left-4 z-50 bg-primary text-white p-2 rounded-lg shadow-lg hover:bg-opacity-90 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>

            <div class="p-4 md:p-8">
                @yield('content')
            </div>
        </div>
    @endguest

    {{-- Sidebar Toggle Script --}}
    @auth
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.getElementById('main-content');
            const toggleBtn = document.getElementById('sidebarToggle');
            const menuIcon = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>`;
            const closeIcon = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>`;
            
            // Check screen size
            let isDesktop = window.innerWidth >= 1024;
            let sidebarOpen = isDesktop;

            // Initial State
            function updateState() {
                if (window.innerWidth >= 1024) {
                    sidebar.classList.remove('-translate-x-full');
                    mainContent.classList.add('lg:ml-[280px]');
                    if(toggleBtn) toggleBtn.classList.add('hidden');
                } else {
                    sidebar.classList.add('-translate-x-full');
                    mainContent.classList.remove('lg:ml-[280px]');
                    if(toggleBtn) {
                        toggleBtn.classList.remove('hidden');
                        toggleBtn.innerHTML = menuIcon;
                    }
                    sidebarOpen = false;
                }
            }

            // Toggle Function
            function toggleSidebar() {
                sidebarOpen = !sidebarOpen;
                if (sidebarOpen) {
                    sidebar.classList.remove('-translate-x-full');
                    toggleBtn.innerHTML = closeIcon;
                } else {
                    sidebar.classList.add('-translate-x-full');
                    toggleBtn.innerHTML = menuIcon;
                }
            }

            if (toggleBtn) {
                toggleBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    toggleSidebar();
                });
            }

            // Close on outside click (mobile)
            document.addEventListener('click', (event) => {
                const isClickInsideSidebar = sidebar.contains(event.target);
                const isClickOnToggle = toggleBtn && toggleBtn.contains(event.target);

                if (!isClickInsideSidebar && !isClickOnToggle && sidebarOpen && window.innerWidth < 1024) {
                    toggleSidebar();
                }
            });

            // Handle Resize
            window.addEventListener('resize', () => {
                updateState();
            });

            // Initialize
            // The initial class states in HTML handle the default desktop view.
            // But we need to make sure the mobile state is correct if loaded on mobile.
             if (window.innerWidth < 1024) {
                 sidebar.classList.add('-translate-x-full');
             }
        });
    </script>
    @endauth
</body>
</html>
