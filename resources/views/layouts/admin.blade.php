<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - Undangan Pernikahan</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800 font-sans antialiased min-h-screen flex flex-col md:flex-row">

    <!-- Mobile Header -->
    <header class="md:hidden bg-[#753230] text-[#FFF0E5] px-4 py-3 flex items-center justify-between shadow-md sticky top-0 z-50">
        <div class="flex items-center gap-2">
            <span class="font-serif font-bold text-lg tracking-wider">Admin Undangan</span>
        </div>
        <button id="mobile-menu-btn" class="p-1 rounded-lg hover:bg-[#582422] transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </header>

    <!-- Sidebar Navigation -->
    <aside id="sidebar" class="hidden md:flex flex-col w-full md:w-64 bg-[#753230] text-[#FFF0E5] shrink-0 min-h-screen border-r border-[#B89C7A]/30">
        <div class="p-5 border-b border-[#B89C7A]/30">
            <h1 class="font-serif text-xl font-bold tracking-wider text-white">Undangan Admin</h1>
            <p class="text-xs text-[#B89C7A] mt-0.5">Punakawan Premium 03</p>
        </div>

        <nav class="p-4 space-y-1 flex-1 text-sm">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-[#582422] text-white font-semibold shadow-inner' : 'hover:bg-[#8E3A37]/50 text-white/80' }}">
                <svg class="w-5 h-5 text-[#B89C7A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all {{ request()->routeIs('admin.settings.*') ? 'bg-[#582422] text-white font-semibold shadow-inner' : 'hover:bg-[#8E3A37]/50 text-white/80' }}">
                <svg class="w-5 h-5 text-[#B89C7A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7 7z"></path>
                </svg>
                <span>Profil & Mempelai</span>
            </a>

            <a href="{{ route('admin.events.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all {{ request()->routeIs('admin.events.*') ? 'bg-[#582422] text-white font-semibold shadow-inner' : 'hover:bg-[#8E3A37]/50 text-white/80' }}">
                <svg class="w-5 h-5 text-[#B89C7A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span>Rangkaian Acara</span>
            </a>

            <a href="{{ route('admin.stories.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all {{ request()->routeIs('admin.stories.*') ? 'bg-[#582422] text-white font-semibold shadow-inner' : 'hover:bg-[#8E3A37]/50 text-white/80' }}">
                <svg class="w-5 h-5 text-[#B89C7A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                <span>Love Story</span>
            </a>

            <a href="{{ route('admin.galleries.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all {{ request()->routeIs('admin.galleries.*') ? 'bg-[#582422] text-white font-semibold shadow-inner' : 'hover:bg-[#8E3A37]/50 text-white/80' }}">
                <svg class="w-5 h-5 text-[#B89C7A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span>Galeri Foto & Video</span>
            </a>

            <a href="{{ route('admin.banks.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all {{ request()->routeIs('admin.banks.*') ? 'bg-[#582422] text-white font-semibold shadow-inner' : 'hover:bg-[#8E3A37]/50 text-white/80' }}">
                <svg class="w-5 h-5 text-[#B89C7A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                </svg>
                <span>Rekening & Kado</span>
            </a>

            <a href="{{ route('admin.rsvps.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all {{ request()->routeIs('admin.rsvps.*') ? 'bg-[#582422] text-white font-semibold shadow-inner' : 'hover:bg-[#8E3A37]/50 text-white/80' }}">
                <svg class="w-5 h-5 text-[#B89C7A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                </svg>
                <span>Buku Tamu & RSVP</span>
            </a>

            <a href="{{ route('admin.guests.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all {{ request()->routeIs('admin.guests.*') ? 'bg-[#582422] text-white font-semibold shadow-inner' : 'hover:bg-[#8E3A37]/50 text-white/80' }}">
                <svg class="w-5 h-5 text-[#B89C7A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                </svg>
                <span>Link WhatsApp Tamu</span>
            </a>
        </nav>

        <div class="p-4 border-t border-[#B89C7A]/30 space-y-2">
            <a href="{{ route('invitation.index') }}" target="_blank" class="flex items-center justify-center gap-2 w-full py-2 px-3 rounded-xl bg-white/10 hover:bg-white/20 text-xs font-medium text-white transition-all">
                <svg class="w-4 h-4 text-[#B89C7A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                </svg>
                <span>Buka Undangan</span>
            </a>

            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="flex items-center justify-center gap-2 w-full py-2 px-3 rounded-xl bg-rose-900/60 hover:bg-rose-900 text-xs font-medium text-rose-100 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span>Keluar (Logout)</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 p-4 md:p-8 max-w-6xl mx-auto w-full">
        <!-- Flash Notifications -->
        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm flex items-center gap-3">
                <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm">
                <p class="font-semibold mb-1">Terdapat beberapa kesalahan input:</p>
                <ul class="list-disc list-inside space-y-1 text-xs">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <script>
        // Toggle Mobile Menu
        const mobileBtn = document.getElementById('mobile-menu-btn');
        const sidebar = document.getElementById('sidebar');
        if (mobileBtn && sidebar) {
            mobileBtn.addEventListener('click', () => {
                sidebar.classList.toggle('hidden');
            });
        }
    </script>
</body>
</html>
