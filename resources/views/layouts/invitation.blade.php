<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>The Wedding of {{ $setting->groom_nickname ?? 'Habib' }} & {{ $setting->bride_nickname ?? 'Adiba' }}</title>
    <meta name="description" content="Pernikahan {{ $setting->groom_name ?? 'Habib' }} & {{ $setting->bride_name ?? 'Adiba' }} - {{ $setting->wedding_date ? $setting->wedding_date->translatedFormat('l, d F Y') : 'Senin, 28 Desember 2026' }}">
    
    <!-- Open Graph for WhatsApp & Social Media Preview -->
    <meta property="og:title" content="The Wedding of {{ $setting->groom_nickname ?? 'Habib' }} & {{ $setting->bride_nickname ?? 'Adiba' }}">
    <meta property="og:description" content="Kepada Yth. Bapak/Ibu/Saudara/i {{ $guestName }}. Tanpa mengurangi rasa hormat, kami mengundang Anda untuk menghadiri pernikahan kami.">
    <meta property="og:image" content="{{ $setting->cover_photo ?? 'https://inv.punakawandigital.id/wp-content/uploads/2025/05/Premium-Vintage-03-3.webp' }}">
    <meta property="og:type" content="website">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caudex:ital,wght@0,400;0,700;1,400&family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=Great+Vibes&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .font-script {
            font-family: 'Great Vibes', cursive;
        }
        .font-cormorant {
            font-family: 'Cormorant Garamond', Georgia, serif;
        }
        .font-caudex {
            font-family: 'Caudex', Georgia, serif;
        }
        .font-montserrat {
            font-family: 'Montserrat', sans-serif;
        }
        .bg-pattern {
            background-color: #FFF0E5;
            background-image: radial-gradient(rgba(184, 156, 122, 0.15) 1px, transparent 1px);
            background-size: 20px 20px;
        }
        .vintage-border {
            border: 1px solid rgba(184, 156, 122, 0.4);
            box-shadow: 0 4px 20px -2px rgba(117, 50, 48, 0.08);
        }
        .ornament-line {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }
        .ornament-line::before,
        .ornament-line::after {
            content: '';
            height: 1px;
            width: 45px;
            background: #B89C7A;
            opacity: 0.6;
        }
    </style>
</head>
<body class="bg-[#1C1514] text-[#373838] font-montserrat antialiased selection:bg-[#753230] selection:text-[#FFF0E5]">

    <!-- Outer Container (Mobile-first app wrapper centered on desktop) -->
    <div class="relative max-w-md mx-auto min-h-screen bg-[#FFF0E5] shadow-2xl overflow-x-hidden">
        
        <!-- Main Content -->
        @yield('content')

        <!-- Floating Music Player Button -->
        <div id="music-container" class="hidden fixed bottom-24 right-4 z-40">
            <button id="music-toggle" class="w-11 h-11 rounded-full bg-[#753230] text-[#FFF0E5] shadow-lg flex items-center justify-center border-2 border-[#B89C7A] hover:scale-105 active:scale-95 transition-all" aria-label="Toggle Background Music">
                <svg id="music-icon-playing" class="w-5 h-5 animate-spin-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                </svg>
                <svg id="music-icon-paused" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2"></path>
                </svg>
            </button>
        </div>

        <!-- Hidden Audio Element -->
        <audio id="wedding-audio" loop preload="auto">
            <source src="{{ $setting->background_music ?? 'https://inv.punakawandigital.id/wp-content/uploads/2026/06/golden-hour-jvke-cinematic-violin-cover.mp3' }}" type="audio/mpeg">
        </audio>

        <!-- Bottom Navigation Bar -->
        <nav id="bottom-nav" class="hidden fixed bottom-0 left-0 right-0 max-w-md mx-auto z-40 bg-[#753230]/95 backdrop-blur-md border-t border-[#B89C7A]/40 text-[#FFF0E5] shadow-lg">
            <div class="flex items-center justify-around py-2.5 px-1">
                <a href="#hero" class="flex flex-col items-center gap-1 text-[11px] hover:text-[#B89C7A] transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span>Home</span>
                </a>
                <a href="#mempelai" class="flex flex-col items-center gap-1 text-[11px] hover:text-[#B89C7A] transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    <span>Mempelai</span>
                </a>
                <a href="#acara" class="flex flex-col items-center gap-1 text-[11px] hover:text-[#B89C7A] transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span>Acara</span>
                </a>
                <a href="#galeri" class="flex flex-col items-center gap-1 text-[11px] hover:text-[#B89C7A] transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span>Galeri</span>
                </a>
                <a href="#hadiah" class="flex flex-col items-center gap-1 text-[11px] hover:text-[#B89C7A] transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V6a2 2 0 10-2 2h2zm0 0H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V10a2 2 0 00-2-2h-8z"></path>
                    </svg>
                    <span>Kado</span>
                </a>
                <a href="#rsvp" class="flex flex-col items-center gap-1 text-[11px] hover:text-[#B89C7A] transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                    </svg>
                    <span>Ucapan</span>
                </a>
            </div>
        </nav>

        <!-- Floating Toast Alert -->
        <div id="toast" class="fixed top-5 left-1/2 -translate-x-1/2 z-50 transform -translate-y-20 opacity-0 transition-all duration-300 pointer-events-none">
            <div class="bg-[#753230] text-[#FFF0E5] px-4 py-2.5 rounded-full shadow-2xl border border-[#B89C7A] text-xs font-medium flex items-center gap-2">
                <svg class="w-4 h-4 text-[#B89C7A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span id="toast-text">Berhasil disalin!</span>
            </div>
        </div>

    </div>

    <!-- Global Javascript for Invitation -->
    <script>
        // Audio & Cover Management
        const audio = document.getElementById('wedding-audio');
        const musicToggle = document.getElementById('music-toggle');
        const musicIconPlaying = document.getElementById('music-icon-playing');
        const musicIconPaused = document.getElementById('music-icon-paused');
        const musicContainer = document.getElementById('music-container');
        const bottomNav = document.getElementById('bottom-nav');
        let isPlaying = false;

        function openInvitation() {
            const cover = document.getElementById('cover-screen');
            if (cover) {
                cover.style.transform = 'translateY(-100%)';
                cover.style.transition = 'transform 0.8s cubic-bezier(0.77, 0, 0.175, 1)';
                setTimeout(() => {
                    cover.classList.add('hidden');
                }, 850);
            }

            document.body.classList.remove('overflow-hidden');
            if (musicContainer) musicContainer.classList.remove('hidden');
            if (bottomNav) bottomNav.classList.remove('hidden');

            // Play music
            if (audio) {
                audio.play().then(() => {
                    isPlaying = true;
                    updateMusicIcon();
                }).catch(err => {
                    console.log('Audio autoplay prevented:', err);
                });
            }
        }

        function toggleMusic() {
            if (!audio) return;
            if (isPlaying) {
                audio.pause();
                isPlaying = false;
            } else {
                audio.play();
                isPlaying = true;
            }
            updateMusicIcon();
        }

        function updateMusicIcon() {
            if (isPlaying) {
                musicIconPlaying.classList.remove('hidden');
                musicIconPaused.classList.add('hidden');
            } else {
                musicIconPlaying.classList.add('hidden');
                musicIconPaused.classList.remove('hidden');
            }
        }

        if (musicToggle) {
            musicToggle.addEventListener('click', toggleMusic);
        }

        // Toast Notification Helper
        function showToast(message) {
            const toast = document.getElementById('toast');
            const toastText = document.getElementById('toast-text');
            if (!toast || !toastText) return;

            toastText.textContent = message;
            toast.classList.remove('-translate-y-20', 'opacity-0');
            toast.classList.add('translate-y-0', 'opacity-100');

            setTimeout(() => {
                toast.classList.add('-translate-y-20', 'opacity-0');
                toast.classList.remove('translate-y-0', 'opacity-100');
            }, 2500);
        }

        // Copy text to clipboard
        function copyToClipboard(text, successMessage) {
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(text).then(() => {
                    showToast(successMessage || 'Berhasil disalin ke clipboard!');
                }).catch(() => {
                    fallbackCopy(text, successMessage);
                });
            } else {
                fallbackCopy(text, successMessage);
            }
        }

        function fallbackCopy(text, successMessage) {
            const textArea = document.createElement("textarea");
            textArea.value = text;
            textArea.style.position = "fixed";
            textArea.style.left = "-999999px";
            textArea.style.top = "-999999px";
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();
            try {
                document.execCommand('copy');
                showToast(successMessage || 'Berhasil disalin ke clipboard!');
            } catch (err) {
                showToast('Gagal menyalin text');
            }
            document.body.removeChild(textArea);
        }
    </script>

    @stack('scripts')
</body>
</html>
