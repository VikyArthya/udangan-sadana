@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">

    <!-- Header Banner -->
    <div class="bg-gradient-to-r from-[#753230] to-[#582422] rounded-3xl p-6 md:p-8 text-white shadow-xl flex flex-col md:flex-row items-start md:items-center justify-between gap-4 border border-[#B89C7A]/40">
        <div>
            <h2 class="font-serif text-2xl md:text-3xl font-bold">Halo, Administrator!</h2>
            <p class="text-[#D8C3A8] text-sm mt-1">
                Pernikahan {{ $setting->groom_name ?? 'Habib' }} & {{ $setting->bride_name ?? 'Adiba' }} • {{ $setting->wedding_date ? $setting->wedding_date->translatedFormat('d F Y') : '28 Desember 2026' }}
            </p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('invitation.index') }}" target="_blank"
               class="px-4 py-2 rounded-xl bg-[#B89C7A] text-[#1C1514] font-semibold text-xs tracking-wider uppercase hover:bg-[#D8C3A8] transition-all flex items-center gap-1.5 shadow">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                </svg>
                <span>Preview Undangan</span>
            </a>
            <a href="{{ route('admin.guests.index') }}"
               class="px-4 py-2 rounded-xl bg-white/20 text-white font-semibold text-xs tracking-wider uppercase hover:bg-white/30 transition-all flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                </svg>
                <span>Buat Link Tamu</span>
            </a>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm">
            <div class="flex items-center justify-between text-gray-500 mb-2">
                <span class="text-xs font-semibold uppercase tracking-wider">Total Ucapan</span>
                <span class="p-2 rounded-lg bg-purple-50 text-purple-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                    </svg>
                </span>
            </div>
            <div class="text-2xl font-bold text-gray-800">{{ $totalRsvp }}</div>
            <p class="text-[11px] text-gray-400 mt-1">Doa restu masuk</p>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm">
            <div class="flex items-center justify-between text-gray-500 mb-2">
                <span class="text-xs font-semibold uppercase tracking-wider">Tamu Hadir</span>
                <span class="p-2 rounded-lg bg-emerald-50 text-emerald-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </span>
            </div>
            <div class="text-2xl font-bold text-emerald-600">{{ $totalHadir }}</div>
            <p class="text-[11px] text-gray-400 mt-1">{{ $totalGuests }} perkiraan pax</p>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm">
            <div class="flex items-center justify-between text-gray-500 mb-2">
                <span class="text-xs font-semibold uppercase tracking-wider">Tidak Hadir</span>
                <span class="p-2 rounded-lg bg-rose-50 text-rose-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </span>
            </div>
            <div class="text-2xl font-bold text-rose-600">{{ $totalTidakHadir }}</div>
            <p class="text-[11px] text-gray-400 mt-1">Izin berhalangan</p>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm">
            <div class="flex items-center justify-between text-gray-500 mb-2">
                <span class="text-xs font-semibold uppercase tracking-wider">Galeri Foto</span>
                <span class="p-2 rounded-lg bg-amber-50 text-amber-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </span>
            </div>
            <div class="text-2xl font-bold text-gray-800">{{ $totalPhotos }}</div>
            <p class="text-[11px] text-gray-400 mt-1">Foto prewedding aktif</p>
        </div>
    </div>

    <!-- Quick Navigation Shortcuts -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="{{ route('admin.settings.index') }}" class="p-5 rounded-2xl bg-white border border-gray-200 shadow-sm hover:border-[#753230] transition-all flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-[#FAF4F4] text-[#753230] flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
            </div>
            <div>
                <h4 class="font-bold text-gray-800 text-sm">Edit Data Mempelai</h4>
                <p class="text-xs text-gray-500 mt-0.5">Ubah nama, orang tua, foto, lagu latar & kutipan</p>
            </div>
        </a>

        <a href="{{ route('admin.events.index') }}" class="p-5 rounded-2xl bg-white border border-gray-200 shadow-sm hover:border-[#753230] transition-all flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-[#FAF4F4] text-[#753230] flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <div>
                <h4 class="font-bold text-gray-800 text-sm">Jadwal Akad & Resepsi</h4>
                <p class="text-xs text-gray-500 mt-0.5">Ubah tanggal, jam, alamat, dan Google Maps</p>
            </div>
        </a>

        <a href="{{ route('admin.banks.index') }}" class="p-5 rounded-2xl bg-white border border-gray-200 shadow-sm hover:border-[#753230] transition-all flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-[#FAF4F4] text-[#753230] flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                </svg>
            </div>
            <div>
                <h4 class="font-bold text-gray-800 text-sm">Amplop & Rekening Bank</h4>
                <p class="text-xs text-gray-500 mt-0.5">Kelola rekening BCA/Mandiri & alamat kado</p>
            </div>
        </a>
    </div>

    <!-- Recent Wishes Table -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-gray-100 flex items-center justify-between">
            <div>
                <h3 class="font-bold text-gray-800 text-base">Ucapan & Doa Restu Terbaru</h3>
                <p class="text-xs text-gray-400 mt-0.5">Daftar ucapan yang baru saja dikirim oleh tamu undangan</p>
            </div>
            <a href="{{ route('admin.rsvps.index') }}" class="text-xs font-semibold text-[#753230] hover:underline">
                Lihat Semua ({{ $totalRsvp }}) →
            </a>
        </div>

        <div class="divide-y divide-gray-100">
            @forelse($recentWishes as $wish)
                <div class="p-4 hover:bg-gray-50 flex items-start justify-between gap-4">
                    <div class="space-y-1">
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-sm text-gray-900">{{ $wish->name }}</span>
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold
                                @if($wish->attendance === 'hadir') bg-emerald-100 text-emerald-800
                                @elseif($wish->attendance === 'tidak_hadir') bg-rose-100 text-rose-800
                                @else bg-amber-100 text-amber-800 @endif">
                                {{ ucfirst(str_replace('_', ' ', $wish->attendance)) }} ({{ $wish->guest_count }} org)
                            </span>
                        </div>
                        <p class="text-xs text-gray-600 leading-relaxed">{{ $wish->message }}</p>
                        <p class="text-[10px] text-gray-400">{{ $wish->created_at ? $wish->created_at->diffForHumans() : 'Baru saja' }}</p>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center text-gray-400 text-sm">
                    Belum ada ucapan doa restu yang masuk.
                </div>
            @endforelse
        </div>
    </div>

</div>
@endsection
