@extends('layouts.admin')

@section('title', 'Rangkaian Acara')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Rangkaian Acara Pernikahan</h2>
            <p class="text-xs text-gray-500 mt-1">Kelola jadwal Akad Nikah, Resepsi, alamat gedung, dan pin Google Maps</p>
        </div>
    </div>

    <!-- Existing Events List -->
    <div class="space-y-6">
        @foreach($events as $event)
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <div class="flex items-center justify-between border-b pb-3 mb-4">
                    <span class="px-3 py-1 rounded-full bg-[#FAF4F4] text-[#753230] text-xs font-bold border border-[#B89C7A]/30">
                        Acara #{{ $loop->iteration }}: {{ $event->title }}
                    </span>

                    <form method="POST" action="{{ route('admin.events.destroy', $event->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus acara ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xs text-rose-600 hover:text-rose-800 font-semibold flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            <span>Hapus</span>
                        </button>
                    </form>
                </div>

                <form method="POST" action="{{ route('admin.events.update', $event->id) }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Acara</label>
                            <input type="text" name="title" value="{{ old('title', $event->title) }}" required
                                   class="w-full px-3.5 py-2 text-sm rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#753230] focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Hari & Tanggal</label>
                            <input type="text" name="date_text" value="{{ old('date_text', $event->date_text) }}" required
                                   placeholder="Senin, 28 Desember 2026"
                                   class="w-full px-3.5 py-2 text-sm rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#753230] focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Waktu Pelaksanaan</label>
                            <input type="text" name="time_text" value="{{ old('time_text', $event->time_text) }}" required
                                   placeholder="Pukul 08.00 WIB - Selesai"
                                   class="w-full px-3.5 py-2 text-sm rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#753230] focus:outline-none">
                        </div>

                        <div class="md:col-span-1">
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Tempat / Gedung</label>
                            <input type="text" name="venue_name" value="{{ old('venue_name', $event->venue_name) }}" required
                                   placeholder="Kediaman Mempelai Wanita"
                                   class="w-full px-3.5 py-2 text-sm rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#753230] focus:outline-none">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Alamat Lengkap</label>
                            <input type="text" name="venue_address" value="{{ old('venue_address', $event->venue_address) }}" required
                                   placeholder="Ds Pagu, Wates, Kediri, Jawa Timur"
                                   class="w-full px-3.5 py-2 text-sm rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#753230] focus:outline-none">
                        </div>

                        <div class="md:col-span-3">
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Tautan Google Maps</label>
                            <input type="text" name="maps_url" value="{{ old('maps_url', $event->maps_url) }}"
                                   placeholder="https://maps.google.com/?q=..."
                                   class="w-full px-3.5 py-2 text-sm rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#753230] focus:outline-none">
                        </div>
                    </div>

                    <div class="flex justify-end pt-2">
                        <button type="submit" class="px-5 py-2 rounded-xl bg-[#753230] text-[#FFF0E5] font-semibold text-xs hover:bg-[#8E3A37] transition-all">
                            Perbarui Acara Ini
                        </button>
                    </div>
                </form>
            </div>
        @endforeach
    </div>

    <!-- Add New Event Card -->
    <div class="bg-gray-50 rounded-2xl border-2 border-dashed border-gray-300 p-6">
        <h3 class="text-sm font-bold text-gray-700 mb-4 flex items-center gap-2">
            <svg class="w-4 h-4 text-[#753230]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <span>Tambah Acara Baru (Misal: Unduh Mantu, Pengajian, Siraman)</span>
        </h3>

        <form method="POST" action="{{ route('admin.events.store') }}" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Acara</label>
                    <input type="text" name="title" placeholder="Siraman / Ngunduh Mantu" required
                           class="w-full px-3.5 py-2 text-sm rounded-xl border border-gray-300 bg-white focus:ring-2 focus:ring-[#753230] focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Hari & Tanggal</label>
                    <input type="text" name="date_text" placeholder="Minggu, 27 Desember 2026" required
                           class="w-full px-3.5 py-2 text-sm rounded-xl border border-gray-300 bg-white focus:ring-2 focus:ring-[#753230] focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Waktu Pelaksanaan</label>
                    <input type="text" name="time_text" placeholder="Pukul 13.00 WIB - Selesai" required
                           class="w-full px-3.5 py-2 text-sm rounded-xl border border-gray-300 bg-white focus:ring-2 focus:ring-[#753230] focus:outline-none">
                </div>

                <div class="md:col-span-1">
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Tempat / Gedung</label>
                    <input type="text" name="venue_name" placeholder="Gedung Serbaguna..." required
                           class="w-full px-3.5 py-2 text-sm rounded-xl border border-gray-300 bg-white focus:ring-2 focus:ring-[#753230] focus:outline-none">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Alamat Lengkap</label>
                    <input type="text" name="venue_address" placeholder="Jl. Raya..." required
                           class="w-full px-3.5 py-2 text-sm rounded-xl border border-gray-300 bg-white focus:ring-2 focus:ring-[#753230] focus:outline-none">
                </div>

                <div class="md:col-span-3">
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Tautan Google Maps</label>
                    <input type="text" name="maps_url" placeholder="https://maps.google.com/..."
                           class="w-full px-3.5 py-2 text-sm rounded-xl border border-gray-300 bg-white focus:ring-2 focus:ring-[#753230] focus:outline-none">
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-gray-800 text-white font-semibold text-xs hover:bg-black transition-all">
                    + Simpan Acara Baru
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
