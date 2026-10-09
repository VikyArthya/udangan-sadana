@extends('layouts.admin')

@section('title', 'Profil & Mempelai')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Profil Mempelai & Pengaturan Umum</h2>
            <p class="text-xs text-gray-500 mt-1">Ubah data mempelai, foto, lagu pengiring, kutipan ayat, dan live streaming</p>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- 1. DATA MEMPELAI PRIA -->
        <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
            <h3 class="text-base font-bold text-[#753230] border-b pb-3 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7 7z"></path>
                </svg>
                <span>Mempelai Pria (Groom)</span>
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Lengkap & Gelar</label>
                    <input type="text" name="groom_name" value="{{ old('groom_name', $setting->groom_name) }}" required
                           class="w-full px-3.5 py-2 text-sm rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#753230] focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Panggilan</label>
                    <input type="text" name="groom_nickname" value="{{ old('groom_nickname', $setting->groom_nickname) }}" required
                           class="w-full px-3.5 py-2 text-sm rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#753230] focus:outline-none">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Keterangan Putra dari Orang Tua</label>
                    <input type="text" name="groom_parent_status" value="{{ old('groom_parent_status', $setting->groom_parent_status) }}"
                           placeholder="Putra Kedua dari Bapak M. Dawam & (Almh) Ibu Dewi Sudarwati"
                           class="w-full px-3.5 py-2 text-sm rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#753230] focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Username Instagram</label>
                    <div class="flex items-center">
                        <span class="px-3 py-2 bg-gray-100 border border-r-0 border-gray-300 rounded-l-xl text-xs text-gray-500">@</span>
                        <input type="text" name="groom_instagram" value="{{ old('groom_instagram', ltrim($setting->groom_instagram, '@')) }}"
                               placeholder="habibyulianto"
                               class="w-full px-3.5 py-2 text-sm rounded-r-xl border border-gray-300 focus:ring-2 focus:ring-[#753230] focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">URL Foto atau Upload Foto Baru</label>
                    <input type="text" name="groom_photo" value="{{ old('groom_photo', $setting->groom_photo) }}" placeholder="https://..."
                           class="w-full px-3.5 py-2 text-sm rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#753230] focus:outline-none mb-1.5">
                    <input type="file" name="groom_photo_file" accept="image/*" class="text-xs text-gray-500">
                </div>
            </div>
        </div>

        <!-- 2. DATA MEMPELAI WANITA -->
        <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
            <h3 class="text-base font-bold text-[#753230] border-b pb-3 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7 7z"></path>
                </svg>
                <span>Mempelai Wanita (Bride)</span>
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Lengkap & Gelar</label>
                    <input type="text" name="bride_name" value="{{ old('bride_name', $setting->bride_name) }}" required
                           class="w-full px-3.5 py-2 text-sm rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#753230] focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Panggilan</label>
                    <input type="text" name="bride_nickname" value="{{ old('bride_nickname', $setting->bride_nickname) }}" required
                           class="w-full px-3.5 py-2 text-sm rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#753230] focus:outline-none">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Keterangan Putri dari Orang Tua</label>
                    <input type="text" name="bride_parent_status" value="{{ old('bride_parent_status', $setting->bride_parent_status) }}"
                           placeholder="Putri Pertama dari Bapak Anas Rifai & Ibu Kholifah"
                           class="w-full px-3.5 py-2 text-sm rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#753230] focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Username Instagram</label>
                    <div class="flex items-center">
                        <span class="px-3 py-2 bg-gray-100 border border-r-0 border-gray-300 rounded-l-xl text-xs text-gray-500">@</span>
                        <input type="text" name="bride_instagram" value="{{ old('bride_instagram', ltrim($setting->bride_instagram, '@')) }}"
                               placeholder="adibaputri"
                               class="w-full px-3.5 py-2 text-sm rounded-r-xl border border-gray-300 focus:ring-2 focus:ring-[#753230] focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">URL Foto atau Upload Foto Baru</label>
                    <input type="text" name="bride_photo" value="{{ old('bride_photo', $setting->bride_photo) }}" placeholder="https://..."
                           class="w-full px-3.5 py-2 text-sm rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#753230] focus:outline-none mb-1.5">
                    <input type="file" name="bride_photo_file" accept="image/*" class="text-xs text-gray-500">
                </div>
            </div>
        </div>

        <!-- 3. FOTO SAMPUL & MUSIK LATAR -->
        <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
            <h3 class="text-base font-bold text-[#753230] border-b pb-3 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                </svg>
                <span>Sampul, Tanggal & Musik Pengiring</span>
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Tanggal & Waktu Pernikahan (Untuk Countdown)</label>
                    <input type="datetime-local" name="wedding_date" 
                           value="{{ old('wedding_date', $setting->wedding_date ? $setting->wedding_date->format('Y-m-d\TH:i') : '2026-12-28T08:00') }}"
                           class="w-full px-3.5 py-2 text-sm rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#753230] focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Lagu Pengiring (URL MP3 atau File MP3)</label>
                    <input type="text" name="background_music" value="{{ old('background_music', $setting->background_music) }}"
                           placeholder="https://.../lagu.mp3"
                           class="w-full px-3.5 py-2 text-sm rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#753230] focus:outline-none mb-1.5">
                    <input type="file" name="background_music_file" accept="audio/*" class="text-xs text-gray-500">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Foto Sampul (Cover Pop-up)</label>
                    <input type="text" name="cover_photo" value="{{ old('cover_photo', $setting->cover_photo) }}"
                           class="w-full px-3.5 py-2 text-sm rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#753230] focus:outline-none mb-1.5">
                    <input type="file" name="cover_photo_file" accept="image/*" class="text-xs text-gray-500">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Foto Hero (Background Halaman Utama)</label>
                    <input type="text" name="hero_photo" value="{{ old('hero_photo', $setting->hero_photo) }}"
                           class="w-full px-3.5 py-2 text-sm rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#753230] focus:outline-none mb-1.5">
                    <input type="file" name="hero_photo_file" accept="image/*" class="text-xs text-gray-500">
                </div>
            </div>
        </div>

        <!-- 4. AYAT & KUTIPAN ROMANTIS -->
        <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
            <h3 class="text-base font-bold text-[#753230] border-b pb-3 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                <span>Ayat Suci & Kutipan Doa</span>
            </h3>

            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Teks Ayat Arab (Opsional)</label>
                    <textarea name="quote_arabic" rows="2" dir="rtl"
                              class="w-full px-3.5 py-2 text-sm rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#753230] focus:outline-none font-serif">{{ old('quote_arabic', $setting->quote_arabic) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Terjemahan Kutipan / Ayat</label>
                    <textarea name="quote_text" rows="3"
                              class="w-full px-3.5 py-2 text-sm rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#753230] focus:outline-none">{{ old('quote_text', $setting->quote_text) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Sumber Kutipan / Surat</label>
                    <input type="text" name="quote_source" value="{{ old('quote_source', $setting->quote_source) }}"
                           placeholder="(Qs. Ar-Rum : 21)"
                           class="w-full px-3.5 py-2 text-sm rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#753230] focus:outline-none">
                </div>
            </div>
        </div>

        <!-- 5. LIVE STREAMING (OPSIONAL) -->
        <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
            <h3 class="text-base font-bold text-[#753230] border-b pb-3 mb-4 flex items-center justify-between">
                <span>Siaran Langsung (Live Streaming)</span>
                <label class="flex items-center gap-2 text-xs font-semibold text-gray-700 cursor-pointer">
                    <input type="checkbox" name="stream_enabled" value="1" {{ old('stream_enabled', $setting->stream_enabled) ? 'checked' : '' }}
                           class="rounded text-[#753230] focus:ring-[#753230]">
                    <span>Aktifkan Seksi Live Streaming</span>
                </label>
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Platform Siaran</label>
                    <input type="text" name="stream_platform" value="{{ old('stream_platform', $setting->stream_platform) }}"
                           placeholder="Instagram Live & YouTube"
                           class="w-full px-3.5 py-2 text-sm rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#753230] focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Tautan / Link Siaran Langsung</label>
                    <input type="text" name="stream_url" value="{{ old('stream_url', $setting->stream_url) }}"
                           placeholder="https://instagram.com/..."
                           class="w-full px-3.5 py-2 text-sm rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#753230] focus:outline-none">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Jadwal Waktu Siaran</label>
                    <input type="text" name="stream_time" value="{{ old('stream_time', $setting->stream_time) }}"
                           placeholder="Senin, 28 Desember 2026 - Pukul 08.00 WIB"
                           class="w-full px-3.5 py-2 text-sm rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#753230] focus:outline-none">
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-8 py-3 rounded-xl bg-[#753230] text-[#FFF0E5] font-semibold text-sm hover:bg-[#8E3A37] shadow-lg transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>Simpan Seluruh Perubahan</span>
            </button>
        </div>
    </form>

</div>
@endsection
