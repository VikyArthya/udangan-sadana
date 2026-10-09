@extends('layouts.invitation')

@section('content')

<!-- ========================================== -->
<!-- 1. COVER SCREEN (Modal Opening Overlay)    -->
<!-- ========================================== -->
<div id="cover-screen" class="fixed inset-0 z-50 flex flex-col justify-between items-center text-center p-6 bg-[#1C1514] text-[#FFF0E5] bg-cover bg-center overflow-hidden"
     style="background-image: linear-gradient(to bottom, rgba(28,21,20,0.65), rgba(117,50,48,0.85)), url('{{ $setting->cover_photo ?? 'https://inv.punakawandigital.id/wp-content/uploads/2025/05/Premium-Vintage-03-3.webp' }}');">
    
    <!-- Top Floral Ornament -->
    <div class="pt-8">
        <p class="font-cormorant text-xs tracking-[0.25em] uppercase text-[#B89C7A] mb-1">Wedding Invitation</p>
        <div class="ornament-line mx-auto w-40 opacity-70"></div>
    </div>

    <!-- Center Couple & Guest Box -->
    <div class="my-auto max-w-sm w-full py-6 px-4 rounded-2xl bg-black/30 backdrop-blur-sm border border-[#B89C7A]/30">
        <p class="font-cormorant italic text-sm tracking-widest text-[#B89C7A] mb-2">The Wedding of</p>
        <h1 class="font-cormorant text-3xl sm:text-4xl font-semibold tracking-wider text-[#FFF0E5] mb-4">
            {{ $setting->groom_nickname ?? 'Habib' }} <span class="font-script text-2xl text-[#B89C7A]">&</span> {{ $setting->bride_nickname ?? 'Adiba' }}
        </h1>

        <!-- Date Pill -->
        <div class="inline-block px-4 py-1 rounded-full border border-[#B89C7A]/50 bg-[#753230]/40 text-xs font-medium tracking-widest text-[#B89C7A] mb-8">
            {{ $setting->wedding_date ? $setting->wedding_date->format('d . m . Y') : '28 . 12 . 2026' }}
        </div>

        <!-- Guest Name Box -->
        <div class="bg-[#FFF0E5]/10 border border-[#B89C7A]/40 rounded-xl p-4 mb-6">
            <p class="text-[11px] text-[#D8C3A8] uppercase tracking-wider mb-1">Kepada Yth. Bapak/Ibu/Saudara/i:</p>
            <h2 class="font-cormorant text-xl font-bold text-[#FFF0E5] capitalize">{{ $guestName }}</h2>
            <p class="text-[10px] text-[#D8C3A8]/80 mt-1 italic">*Mohon maaf bila ada kesalahan penulisan nama/gelar</p>
        </div>

        <!-- Open Invitation Button -->
        <button onclick="openInvitation()" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-full bg-[#753230] text-[#FFF0E5] font-medium text-xs tracking-wider uppercase border border-[#B89C7A] shadow-xl hover:bg-[#8E3A37] hover:scale-105 active:scale-95 transition-all duration-300">
            <svg class="w-4 h-4 text-[#B89C7A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
            <span>Buka Undangan</span>
        </button>
    </div>

    <!-- Bottom Ornament -->
    <div class="pb-4 text-center">
        <p class="text-[10px] text-[#B89C7A]/80 tracking-widest">PUNAKAWAN DIGITAL PREMIUM</p>
    </div>
</div>

<!-- ========================================== -->
<!-- 2. HERO SECTION                            -->
<!-- ========================================== -->
<section id="hero" class="relative min-h-[90vh] flex flex-col justify-center items-center text-center p-6 bg-cover bg-center overflow-hidden"
         style="background-image: linear-gradient(to bottom, rgba(255,240,229,0.8), rgba(255,240,229,0.95)), url('{{ $setting->hero_photo ?? 'https://inv.punakawandigital.id/wp-content/uploads/2026/06/merah-art-numga-3.webp' }}');">
    
    <div class="relative z-10 max-w-xs mx-auto py-12">
        <div class="w-16 h-16 mx-auto mb-4 rounded-full border-2 border-[#B89C7A] p-1 flex items-center justify-center bg-[#753230]">
            <span class="font-cormorant text-xl font-bold text-[#FFF0E5]">{{ substr($setting->groom_nickname ?? 'H', 0, 1) }}&{{ substr($setting->bride_nickname ?? 'A', 0, 1) }}</span>
        </div>

        <p class="font-cormorant italic text-sm tracking-widest text-[#753230] mb-2 uppercase">The Wedding of</p>
        
        <h1 class="font-cormorant text-4xl sm:text-5xl font-bold tracking-wide text-[#753230] mb-3 leading-tight">
            {{ $setting->groom_nickname ?? 'Habib' }}
            <span class="block font-script text-3xl text-[#B89C7A] my-1">&</span>
            {{ $setting->bride_nickname ?? 'Adiba' }}
        </h1>

        <div class="ornament-line mx-auto w-32 my-4"></div>

        <p class="font-caudex text-sm font-semibold tracking-widest text-[#753230]">
            {{ $setting->wedding_date ? $setting->wedding_date->translatedFormat('l, d F Y') : 'Senin, 28 Desember 2026' }}
        </p>
    </div>
</section>

<!-- ========================================== -->
<!-- 3. AYAT SUCI & GREETING                    -->
<!-- ========================================== -->
<section class="py-14 px-6 text-center bg-[#FAF4F4] relative border-y border-[#B89C7A]/20">
    <div class="max-w-sm mx-auto">
        <!-- Bismillah -->
        <p class="font-serif text-2xl text-[#753230] mb-4">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>
        
        <!-- Arabic Quote (if available) -->
        @if(!empty($setting->quote_arabic))
            <p class="font-serif text-lg leading-loose text-[#5D2625] mb-4 text-right sm:text-center" dir="rtl">
                {{ $setting->quote_arabic }}
            </p>
        @endif

        <!-- Quote Translation -->
        <blockquote class="font-caudex italic text-xs leading-relaxed text-[#5E6060] mb-3">
            "{{ $setting->quote_text ?? 'Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang. Sesungguhnya pada yang demikian itu benar-benar terdapat tanda-tanda (kebesaran Allah) bagi kaum yang berpikir.' }}"
        </blockquote>
        <p class="font-cormorant font-bold text-xs tracking-wider text-[#753230] mb-8">{{ $setting->quote_source ?? '(Qs. Ar-Rum : 21)' }}</p>

        <div class="ornament-line mx-auto w-24 my-6"></div>

        <p class="font-caudex text-xs leading-relaxed text-[#373838]">
            Tanpa mengurangi rasa hormat, kami mengundang Bapak/Ibu/Saudara/i serta kerabat sekalian untuk menghadiri acara pernikahan kami:
        </p>
    </div>
</section>

<!-- ========================================== -->
<!-- 4. PROFIL MEMPELAI                         -->
<!-- ========================================== -->
<section id="mempelai" class="py-16 px-6 bg-pattern text-center">
    <div class="max-w-sm mx-auto space-y-12">
        
        <!-- Mempelai Pria -->
        <div class="p-6 rounded-3xl bg-white/70 backdrop-blur-sm border border-[#B89C7A]/40 shadow-xl transition-all">
            <!-- Oval Frame Photo -->
            <div class="relative w-36 h-48 mx-auto mb-5 rounded-[50%] p-1.5 border-2 border-[#B89C7A] overflow-hidden shadow-md">
                <img src="{{ $setting->groom_photo ?? 'https://inv.punakawandigital.id/wp-content/uploads/2026/06/awal-3.jpg' }}" 
                     alt="{{ $setting->groom_name ?? 'Habib Yulianto' }}" 
                     class="w-full h-full object-cover rounded-[50%]">
            </div>

            <h3 class="font-cormorant text-2xl font-bold text-[#753230] mb-2">{{ $setting->groom_name ?? 'Habib Yulianto' }}</h3>
            <p class="font-caudex text-xs text-[#5E6060] leading-relaxed mb-4">
                {{ $setting->groom_parent_status ?? 'Putra Kedua dari Bapak M. Dawam & (Almh) Ibu Dewi Sudarwati' }}
            </p>

            @if($setting->groom_instagram)
                <a href="https://instagram.com/{{ ltrim($setting->groom_instagram, '@') }}" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-[#B89C7A] text-[#753230] text-[11px] font-medium hover:bg-[#753230] hover:text-[#FFF0E5] transition-all">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                    </svg>
                    <span>{{ str_starts_with($setting->groom_instagram, '@') ? $setting->groom_instagram : '@' . $setting->groom_instagram }}</span>
                </a>
            @endif
        </div>

        <!-- Ampersand Divider -->
        <div class="flex items-center justify-center">
            <span class="font-script text-4xl text-[#753230]">&</span>
        </div>

        <!-- Mempelai Wanita -->
        <div class="p-6 rounded-3xl bg-white/70 backdrop-blur-sm border border-[#B89C7A]/40 shadow-xl transition-all">
            <!-- Oval Frame Photo -->
            <div class="relative w-36 h-48 mx-auto mb-5 rounded-[50%] p-1.5 border-2 border-[#B89C7A] overflow-hidden shadow-md">
                <img src="{{ $setting->bride_photo ?? 'https://inv.punakawandigital.id/wp-content/uploads/2026/06/23RSW2031-co.jpg' }}" 
                     alt="{{ $setting->bride_name ?? 'Adiba Putri Syakila' }}" 
                     class="w-full h-full object-cover rounded-[50%]">
            </div>

            <h3 class="font-cormorant text-2xl font-bold text-[#753230] mb-2">{{ $setting->bride_name ?? 'Adiba Putri Syakila' }}</h3>
            <p class="font-caudex text-xs text-[#5E6060] leading-relaxed mb-4">
                {{ $setting->bride_parent_status ?? 'Putri Pertama dari Bapak Anas Rifai & Ibu Kholifah' }}
            </p>

            @if($setting->bride_instagram)
                <a href="https://instagram.com/{{ ltrim($setting->bride_instagram, '@') }}" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-[#B89C7A] text-[#753230] text-[11px] font-medium hover:bg-[#753230] hover:text-[#FFF0E5] transition-all">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                    </svg>
                    <span>{{ str_starts_with($setting->bride_instagram, '@') ? $setting->bride_instagram : '@' . $setting->bride_instagram }}</span>
                </a>
            @endif
        </div>

    </div>
</section>

<!-- ========================================== -->
<!-- 5. COUNTDOWN TIMER                         -->
<!-- ========================================== -->
<section class="py-14 px-6 text-center bg-[#753230] text-[#FFF0E5]">
    <div class="max-w-sm mx-auto">
        <p class="font-cormorant italic text-xs tracking-widest text-[#B89C7A] mb-1">Save The Date</p>
        <h2 class="font-cormorant text-2xl font-bold tracking-wider mb-6">Menuju Hari Bahagia</h2>

        <div class="grid grid-cols-4 gap-2 mb-6">
            <div class="p-3 rounded-2xl bg-[#582422]/70 border border-[#B89C7A]/40">
                <span id="days" class="font-cormorant text-2xl sm:text-3xl font-bold text-[#FFF0E5] block">0</span>
                <span class="text-[10px] text-[#B89C7A] uppercase tracking-wider">Hari</span>
            </div>
            <div class="p-3 rounded-2xl bg-[#582422]/70 border border-[#B89C7A]/40">
                <span id="hours" class="font-cormorant text-2xl sm:text-3xl font-bold text-[#FFF0E5] block">0</span>
                <span class="text-[10px] text-[#B89C7A] uppercase tracking-wider">Jam</span>
            </div>
            <div class="p-3 rounded-2xl bg-[#582422]/70 border border-[#B89C7A]/40">
                <span id="minutes" class="font-cormorant text-2xl sm:text-3xl font-bold text-[#FFF0E5] block">0</span>
                <span class="text-[10px] text-[#B89C7A] uppercase tracking-wider">Menit</span>
            </div>
            <div class="p-3 rounded-2xl bg-[#582422]/70 border border-[#B89C7A]/40">
                <span id="seconds" class="font-cormorant text-2xl sm:text-3xl font-bold text-[#FFF0E5] block">0</span>
                <span class="text-[10px] text-[#B89C7A] uppercase tracking-wider">Detik</span>
            </div>
        </div>
    </div>
</section>

<!-- ========================================== -->
<!-- 6. RANGKAIAN ACARA                         -->
<!-- ========================================== -->
<section id="acara" class="py-16 px-6 bg-[#FAF4F4] text-center">
    <div class="max-w-sm mx-auto">
        <p class="font-cormorant italic text-xs tracking-widest text-[#B89C7A] mb-1">Our Special Day</p>
        <h2 class="font-cormorant text-3xl font-bold text-[#753230] mb-8">Rangkaian Acara</h2>

        <div class="space-y-8">
            @foreach($events as $event)
                <div class="p-6 rounded-3xl bg-white border border-[#B89C7A]/40 shadow-lg relative overflow-hidden">
                    <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-[#FFF0E5] border border-[#B89C7A] flex items-center justify-center text-[#753230]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>

                    <h3 class="font-cormorant text-2xl font-bold text-[#753230] mb-2">{{ $event->title }}</h3>
                    <p class="font-caudex text-xs font-semibold text-[#5D2625] mb-1">{{ $event->date_text }}</p>
                    <p class="font-caudex text-xs text-[#753230] mb-3">{{ $event->time_text }}</p>

                    <div class="ornament-line mx-auto w-20 my-3"></div>

                    <p class="font-caudex text-xs font-bold text-[#373838] uppercase mb-1">{{ $event->venue_name }}</p>
                    <p class="text-[11px] text-[#5E6060] leading-relaxed mb-6">{{ $event->venue_address }}</p>

                    <div class="flex flex-col sm:flex-row items-center justify-center gap-2">
                        @if($event->maps_url)
                            <a href="{{ $event->maps_url }}" target="_blank" rel="noopener noreferrer"
                               class="w-full sm:w-auto inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-full bg-[#753230] text-[#FFF0E5] text-[11px] font-medium border border-[#B89C7A] hover:bg-[#8E3A37] transition-all">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>Lihat Lokasi</span>
                            </a>
                        @endif

                        @if($event->calendar_url)
                            <a href="{{ $event->calendar_url }}" target="_blank" rel="noopener noreferrer"
                               class="w-full sm:w-auto inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-full border border-[#B89C7A] text-[#753230] text-[11px] font-medium hover:bg-[#FFF0E5] transition-all">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>Simpan Tanggal</span>
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>

<!-- ========================================== -->
<!-- 7. LIVE STREAMING (OPTIONAL)               -->
<!-- ========================================== -->
@if($setting->stream_enabled)
<section class="py-14 px-6 bg-[#753230] text-[#FFF0E5] text-center border-t border-[#B89C7A]/40">
    <div class="max-w-sm mx-auto p-6 rounded-3xl bg-[#582422]/80 border border-[#B89C7A]/40 shadow-xl">
        <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-[#753230] border border-[#B89C7A] flex items-center justify-center text-[#B89C7A]">
            <svg class="w-6 h-6 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
            </svg>
        </div>

        <h3 class="font-cormorant text-2xl font-bold tracking-wide mb-2">Live Streaming</h3>
        <p class="text-xs text-[#D8C3A8] leading-relaxed mb-4">
            Kami mengundang Bapak/Ibu/Saudara/i untuk menyaksikan pernikahan kami secara virtual melalui siaran langsung media sosial berikut:
        </p>

        <p class="font-caudex text-xs font-semibold text-[#FFF0E5] mb-4">{{ $setting->stream_time }}</p>

        <a href="{{ $setting->stream_url ?? '#' }}" target="_blank" rel="noopener noreferrer"
           class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#B89C7A] text-[#1C1514] font-semibold text-xs tracking-wider uppercase hover:bg-[#D8C3A8] transition-all">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/>
            </svg>
            <span>Tonton Live Streaming</span>
        </a>
    </div>
</section>
@endif

<!-- ========================================== -->
<!-- 8. LOVE STORY                              -->
<!-- ========================================== -->
@if($stories->isNotEmpty())
<section class="py-16 px-6 bg-[#FFF0E5] text-center">
    <div class="max-w-sm mx-auto">
        <p class="font-cormorant italic text-xs tracking-widest text-[#B89C7A] mb-1">Our Journey</p>
        <h2 class="font-cormorant text-3xl font-bold text-[#753230] mb-8">Love Story</h2>

        <div class="relative border-l-2 border-[#B89C7A]/50 ml-4 sm:ml-6 pl-6 space-y-10 text-left">
            @foreach($stories as $story)
                <div class="relative">
                    <!-- Dot -->
                    <div class="absolute -left-[31px] top-1.5 w-4 h-4 rounded-full bg-[#753230] border-2 border-[#FFF0E5] shadow-md"></div>
                    
                    <div class="p-5 rounded-2xl bg-white border border-[#B89C7A]/30 shadow-md">
                        @if($story->year_or_date)
                            <span class="inline-block px-2.5 py-0.5 rounded-full bg-[#FFF0E5] text-[#753230] text-[10px] font-semibold tracking-wider mb-2">
                                {{ $story->year_or_date }}
                            </span>
                        @endif
                        <h3 class="font-cormorant text-xl font-bold text-[#753230] mb-2">{{ $story->title }}</h3>
                        
                        @if($story->image)
                            <img src="{{ $story->image }}" alt="{{ $story->title }}" class="w-full h-36 object-cover rounded-xl mb-3 border border-[#B89C7A]/20">
                        @endif

                        <p class="text-xs text-[#5E6060] leading-relaxed">{{ $story->story }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- ========================================== -->
<!-- 9. GALERI PREWEDDING & VIDEO               -->
<!-- ========================================== -->
<section id="galeri" class="py-16 px-6 bg-[#FAF4F4] text-center">
    <div class="max-w-sm mx-auto">
        <p class="font-cormorant italic text-xs tracking-widest text-[#B89C7A] mb-1">Sweet Moments</p>
        <h2 class="font-cormorant text-3xl font-bold text-[#753230] mb-8">Galeri Foto</h2>

        <!-- Gallery Grid -->
        <div class="grid grid-cols-2 gap-3 mb-10">
            @foreach($galleries as $gallery)
                <div class="group relative rounded-2xl overflow-hidden shadow-md cursor-pointer aspect-square border border-[#B89C7A]/30"
                     onclick="openLightbox('{{ $gallery->image_url }}', '{{ $gallery->caption }}')">
                    <img src="{{ $gallery->image_url }}" alt="{{ $gallery->caption }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-[#753230]/30 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                        </svg>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Video Prewedding (if available) -->
        @if(!empty($setting->video_url))
            <div class="p-4 rounded-3xl bg-white border border-[#B89C7A]/40 shadow-lg">
                <h3 class="font-cormorant text-xl font-bold text-[#753230] mb-3">Video Prewedding</h3>
                <div class="relative w-full rounded-2xl overflow-hidden aspect-video bg-black shadow-md">
                    @php
                        $videoEmbed = $setting->video_url;
                        if (str_contains($videoEmbed, 'watch?v=')) {
                            $videoEmbed = str_replace('watch?v=', 'embed/', $videoEmbed);
                        } elseif (str_contains($videoEmbed, 'youtu.be/')) {
                            $videoEmbed = str_replace('youtu.be/', 'www.youtube.com/embed/', $videoEmbed);
                        }
                    @endphp
                    <iframe src="{{ $videoEmbed }}" class="w-full h-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- ========================================== -->
<!-- 10. AMPLOP DIGITAL & KIRIM KADO            -->
<!-- ========================================== -->
<section id="hadiah" class="py-16 px-6 bg-[#FFF0E5] text-center">
    <div class="max-w-sm mx-auto">
        <p class="font-cormorant italic text-xs tracking-widest text-[#B89C7A] mb-1">Wedding Gift</p>
        <h2 class="font-cormorant text-3xl font-bold text-[#753230] mb-3">Amplop Digital</h2>
        <p class="text-xs text-[#5E6060] leading-relaxed mb-8">
            Doa restu Anda merupakan karunia yang sangat berarti bagi kami. Namun jika memberi adalah ungkapan tanda kasih, Anda dapat memberi kado secara cashless di bawah ini:
        </p>

        <!-- Bank Accounts -->
        <div class="space-y-4 mb-8">
            @foreach($bankAccounts as $account)
                <div class="p-5 rounded-2xl bg-white border border-[#B89C7A]/40 shadow-md text-left relative overflow-hidden">
                    <div class="flex items-center justify-between mb-3">
                        <span class="px-3 py-1 rounded-full bg-[#753230] text-[#FFF0E5] text-[11px] font-bold tracking-wider">
                            {{ $account->bank_name }}
                        </span>
                        <svg class="w-5 h-5 text-[#B89C7A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                    </div>

                    <p class="text-[11px] text-[#5E6060] mb-0.5">Nomor Rekening:</p>
                    <p class="font-mono text-base font-bold text-[#753230] tracking-wide mb-2" id="rek-{{ $account->id }}">
                        {{ $account->account_number }}
                    </p>

                    <p class="text-[11px] text-[#5E6060] mb-4">a.n {{ $account->account_holder }}</p>

                    <button onclick="copyToClipboard('{{ $account->account_number }}', 'Nomor rekening {{ $account->bank_name }} berhasil disalin!')"
                            class="w-full flex items-center justify-center gap-1.5 py-2 rounded-xl bg-[#FAF4F4] hover:bg-[#753230] text-[#753230] hover:text-[#FFF0E5] text-xs font-medium border border-[#B89C7A] transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path>
                        </svg>
                        <span>Salin No. Rekening</span>
                    </button>
                </div>
            @endforeach
        </div>

        <!-- Kirim Hadiah Fisik -->
        @if(!empty($setting->gift_address))
            <div class="p-5 rounded-2xl bg-white border border-[#B89C7A]/40 shadow-md text-left">
                <div class="flex items-center gap-2 mb-3">
                    <svg class="w-5 h-5 text-[#753230]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V6a2 2 0 10-2 2h2zm0 0H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V10a2 2 0 00-2-2h-8z"></path>
                    </svg>
                    <h3 class="font-cormorant text-xl font-bold text-[#753230]">Kirim Kado Fisik</h3>
                </div>

                <div class="text-xs text-[#5E6060] space-y-1 mb-4">
                    <p><strong class="text-[#373838]">Penerima:</strong> {{ $setting->gift_recipient_name }}</p>
                    <p><strong class="text-[#373838]">No. HP:</strong> {{ $setting->gift_phone }}</p>
                    <p><strong class="text-[#373838]">Alamat:</strong> {{ $setting->gift_address }}</p>
                </div>

                <button onclick="copyToClipboard('{{ $setting->gift_recipient_name }} - {{ $setting->gift_phone }}\n{{ $setting->gift_address }}', 'Alamat pengiriman kado berhasil disalin!')"
                        class="w-full flex items-center justify-center gap-1.5 py-2 rounded-xl bg-[#FAF4F4] hover:bg-[#753230] text-[#753230] hover:text-[#FFF0E5] text-xs font-medium border border-[#B89C7A] transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path>
                    </svg>
                    <span>Salin Alamat Pengiriman</span>
                </button>
            </div>
        @endif

    </div>
</section>

<!-- ========================================== -->
<!-- 11. BUKU TAMU & RSVP                       -->
<!-- ========================================== -->
<section id="rsvp" class="py-16 px-6 bg-[#FAF4F4] text-center">
    <div class="max-w-sm mx-auto">
        <p class="font-cormorant italic text-xs tracking-widest text-[#B89C7A] mb-1">Wishes & Prayers</p>
        <h2 class="font-cormorant text-3xl font-bold text-[#753230] mb-2">Buku Tamu & RSVP</h2>
        <p class="text-xs text-[#5E6060] leading-relaxed mb-8">
            Berikan konfirmasi kehadiran serta doa restu Anda untuk kami.
        </p>

        <!-- Form RSVP -->
        <form id="rsvp-form" class="p-6 rounded-3xl bg-white border border-[#B89C7A]/40 shadow-lg text-left mb-10">
            @csrf
            
            <div class="mb-4">
                <label for="rsvp-name" class="block text-xs font-medium text-[#753230] mb-1">Nama Lengkap</label>
                <input type="text" id="rsvp-name" name="name" required value="{{ $guestName !== 'Tamu Undangan' ? $guestName : '' }}"
                       placeholder="Masukkan nama Anda"
                       class="w-full px-3.5 py-2.5 rounded-xl border border-[#B89C7A]/50 bg-[#FAF4F4] text-xs text-[#373838] focus:outline-none focus:ring-1 focus:ring-[#753230]">
            </div>

            <div class="mb-4">
                <label class="block text-xs font-medium text-[#753230] mb-1">Konfirmasi Kehadiran</label>
                <div class="grid grid-cols-3 gap-2 text-center text-xs">
                    <label class="cursor-pointer">
                        <input type="radio" name="attendance" value="hadir" checked class="peer sr-only">
                        <div class="py-2 px-1 rounded-xl border border-[#B89C7A]/50 peer-checked:bg-[#753230] peer-checked:text-[#FFF0E5] peer-checked:border-[#753230] text-[#5E6060] transition-all">
                            Hadir
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="attendance" value="tidak_hadir" class="peer sr-only">
                        <div class="py-2 px-1 rounded-xl border border-[#B89C7A]/50 peer-checked:bg-[#753230] peer-checked:text-[#FFF0E5] peer-checked:border-[#753230] text-[#5E6060] transition-all">
                            Tidak Hadir
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="attendance" value="ragu" class="peer sr-only">
                        <div class="py-2 px-1 rounded-xl border border-[#B89C7A]/50 peer-checked:bg-[#753230] peer-checked:text-[#FFF0E5] peer-checked:border-[#753230] text-[#5E6060] transition-all">
                            Ragu-ragu
                        </div>
                    </label>
                </div>
            </div>

            <div class="mb-4">
                <label for="rsvp-count" class="block text-xs font-medium text-[#753230] mb-1">Jumlah Tamu (Pax)</label>
                <select id="rsvp-count" name="guest_count"
                        class="w-full px-3 py-2 rounded-xl border border-[#B89C7A]/50 bg-[#FAF4F4] text-xs text-[#373838] focus:outline-none focus:ring-1 focus:ring-[#753230]">
                    <option value="1">1 Orang</option>
                    <option value="2">2 Orang</option>
                    <option value="3">3 Orang</option>
                    <option value="4">4 Orang</option>
                </select>
            </div>

            <div class="mb-5">
                <label for="rsvp-message" class="block text-xs font-medium text-[#753230] mb-1">Ucapan & Doa Restu</label>
                <textarea id="rsvp-message" name="message" rows="3" required
                          placeholder="Tuliskan ucapan dan doa terbaik untuk kedua mempelai..."
                          class="w-full px-3.5 py-2.5 rounded-xl border border-[#B89C7A]/50 bg-[#FAF4F4] text-xs text-[#373838] focus:outline-none focus:ring-1 focus:ring-[#753230] resize-none"></textarea>
            </div>

            <button type="submit" id="rsvp-submit-btn"
                    class="w-full py-3 rounded-full bg-[#753230] text-[#FFF0E5] font-medium text-xs tracking-wider uppercase border border-[#B89C7A] hover:bg-[#8E3A37] transition-all flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                </svg>
                <span>Kirim Ucapan</span>
            </button>
        </form>

        <!-- Daftar Ucapan -->
        <div class="text-left">
            <h3 class="font-cormorant text-xl font-bold text-[#753230] mb-4 text-center">Ucapan Doa Restu ({{ count($wishes) }})</h3>
            
            <div id="wishes-list" class="space-y-3 max-h-96 overflow-y-auto pr-1">
                @foreach($wishes as $wish)
                    <div class="p-4 rounded-2xl bg-white border border-[#B89C7A]/30 shadow-sm">
                        <div class="flex items-center justify-between mb-1.5">
                            <span class="font-cormorant font-bold text-sm text-[#753230]">{{ $wish->name }}</span>
                            <span class="px-2 py-0.5 rounded-full text-[9px] font-semibold
                                @if($wish->attendance === 'hadir') bg-emerald-100 text-emerald-800 border border-emerald-300
                                @elseif($wish->attendance === 'tidak_hadir') bg-rose-100 text-rose-800 border border-rose-300
                                @else bg-amber-100 text-amber-800 border border-amber-300 @endif">
                                {{ ucfirst(str_replace('_', ' ', $wish->attendance)) }}
                            </span>
                        </div>
                        <p class="text-xs text-[#5E6060] leading-relaxed mb-2">{{ $wish->message }}</p>
                        <p class="text-[10px] text-[#A0A0A0]">{{ $wish->created_at ? $wish->created_at->diffForHumans() : 'Baru saja' }}</p>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</section>

<!-- ========================================== -->
<!-- 12. PENUTUP & FOOTER                       -->
<!-- ========================================== -->
<footer class="pt-16 pb-28 px-6 bg-[#1C1514] text-[#FFF0E5] text-center">
    <div class="max-w-sm mx-auto">
        <p class="font-cormorant italic text-xs tracking-widest text-[#B89C7A] mb-2 uppercase">Thank You</p>
        <p class="font-caudex text-xs leading-relaxed text-[#D8C3A8] mb-8">
            Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir dan memberikan doa restu. Atas kehadiran dan doa restunya, kami mengucapkan terima kasih yang sebesar-besarnya.
        </p>

        <p class="font-cormorant italic text-xs text-[#B89C7A] mb-1">Kami yang berbahagia,</p>
        <h2 class="font-cormorant text-3xl font-bold tracking-wide text-[#FFF0E5] mb-8">
            {{ $setting->groom_nickname ?? 'Habib' }} <span class="font-script text-2xl text-[#B89C7A]">&</span> {{ $setting->bride_nickname ?? 'Adiba' }}
        </h2>

        <div class="ornament-line mx-auto w-32 my-6 opacity-40"></div>

        <p class="text-[10px] text-[#A0A0A0] tracking-wider">
            Made with ❤ for {{ $setting->groom_nickname ?? 'Habib' }} & {{ $setting->bride_nickname ?? 'Adiba' }}
        </p>
    </div>
</footer>

<!-- Lightbox Modal for Photos -->
<div id="lightbox-modal" class="hidden fixed inset-0 z-50 bg-black/90 flex flex-col items-center justify-center p-4">
    <button onclick="closeLightbox()" class="absolute top-5 right-5 text-white/80 hover:text-white text-3xl font-bold">&times;</button>
    <img id="lightbox-img" src="" alt="" class="max-w-full max-h-[80vh] rounded-xl object-contain shadow-2xl mb-3">
    <p id="lightbox-caption" class="text-xs text-[#FFF0E5] font-medium tracking-wide"></p>
</div>

@endsection

@push('scripts')
<script>
    // Countdown Timer Logic
    const targetDateStr = "{{ $setting->wedding_date ? $setting->wedding_date->format('Y-m-d H:i:s') : '2026-12-28 08:00:00' }}";
    const targetDate = new Date(targetDateStr.replace(/-/g, '/')).getTime();

    function updateCountdown() {
        const now = new Date().getTime();
        const difference = targetDate - now;

        if (difference > 0) {
            const days = Math.floor(difference / (1000 * 60 * 60 * 24));
            const hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((difference % (1000 * 60)) / 1000);

            document.getElementById('days').innerText = days;
            document.getElementById('hours').innerText = hours;
            document.getElementById('minutes').innerText = minutes;
            document.getElementById('seconds').innerText = seconds;
        } else {
            document.getElementById('days').innerText = '0';
            document.getElementById('hours').innerText = '0';
            document.getElementById('minutes').innerText = '0';
            document.getElementById('seconds').innerText = '0';
        }
    }
    updateCountdown();
    setInterval(updateCountdown, 1000);

    // Lightbox Logic
    function openLightbox(src, caption) {
        const modal = document.getElementById('lightbox-modal');
        const img = document.getElementById('lightbox-img');
        const cap = document.getElementById('lightbox-caption');
        if (!modal || !img) return;

        img.src = src;
        cap.innerText = caption || '';
        modal.classList.remove('hidden');
    }

    function closeLightbox() {
        const modal = document.getElementById('lightbox-modal');
        if (modal) modal.classList.add('hidden');
    }

    // AJAX RSVP Submission
    const rsvpForm = document.getElementById('rsvp-form');
    if (rsvpForm) {
        rsvpForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = document.getElementById('rsvp-submit-btn');
            const originalBtnContent = btn.innerHTML;
            btn.innerHTML = '<span>Mengirimkan...</span>';
            btn.disabled = true;

            const formData = new FormData(rsvpForm);

            fetch("{{ route('invitation.rsvp') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                btn.innerHTML = originalBtnContent;
                btn.disabled = false;
                if (data.success) {
                    showToast(data.message);
                    
                    // Prepend new wish to the list
                    const wishesList = document.getElementById('wishes-list');
                    if (wishesList && data.data) {
                        const newCard = document.createElement('div');
                        newCard.className = 'p-4 rounded-2xl bg-white border border-[#B89C7A]/30 shadow-sm animate-pulse';
                        
                        let badgeClass = 'bg-emerald-100 text-emerald-800 border border-emerald-300';
                        if (data.data.attendance === 'tidak_hadir') badgeClass = 'bg-rose-100 text-rose-800 border border-rose-300';
                        if (data.data.attendance === 'ragu') badgeClass = 'bg-amber-100 text-amber-800 border border-amber-300';

                        newCard.innerHTML = `
                            <div class="flex items-center justify-between mb-1.5">
                                <span class="font-cormorant font-bold text-sm text-[#753230]">${data.data.name}</span>
                                <span class="px-2 py-0.5 rounded-full text-[9px] font-semibold border ${badgeClass}">
                                    ${data.data.attendance.replace('_', ' ').toUpperCase()}
                                </span>
                            </div>
                            <p class="text-xs text-[#5E6060] leading-relaxed mb-2">${data.data.message}</p>
                            <p class="text-[10px] text-[#A0A0A0]">Baru saja</p>
                        `;
                        wishesList.insertBefore(newCard, wishesList.firstChild);
                        setTimeout(() => newCard.classList.remove('animate-pulse'), 1000);
                    }

                    // Reset form message
                    document.getElementById('rsvp-message').value = '';
                } else {
                    showToast('Gagal mengirim RSVP. Silakan coba lagi.');
                }
            })
            .catch(err => {
                btn.innerHTML = originalBtnContent;
                btn.disabled = false;
                showToast('Terjadi kesalahan koneksi.');
            });
        });
    }
</script>
@endpush
