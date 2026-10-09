@extends('layouts.admin')

@section('title', 'Generator Link Tamu WhatsApp')

@section('content')
<div class="space-y-6">

    <div>
        <h2 class="text-2xl font-bold text-gray-800">Generator Tautan Undangan WhatsApp</h2>
        <p class="text-xs text-gray-500 mt-1">Buat tautan personalisasi untuk setiap tamu undangan dan bagikan langsung lewat pesan WhatsApp</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Form Input Generator -->
        <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
            <h3 class="text-base font-bold text-[#753230] mb-4 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Input Data Tamu Undangan</span>
            </h3>

            <form method="GET" action="{{ route('admin.guests.index') }}" class="space-y-4">
                <div>
                    <label for="guest_name" class="block text-xs font-semibold text-gray-700 mb-1">Nama Tamu Undangan</label>
                    <input type="text" id="guest_name" name="guest_name" value="{{ $guestName }}" required
                           placeholder="Contoh: Bapak Joko Widodo & Keluarga"
                           class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#753230] focus:outline-none">
                    <p class="text-[11px] text-gray-400 mt-1">Nama ini akan otomatis tercantum pada amplop sampul depan undangan.</p>
                </div>

                <div>
                    <label for="guest_phone" class="block text-xs font-semibold text-gray-700 mb-1">Nomor WhatsApp (Opsional)</label>
                    <input type="text" id="guest_phone" name="guest_phone" value="{{ $guestPhone }}"
                           placeholder="Contoh: 081234567890"
                           class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#753230] focus:outline-none">
                    <p class="text-[11px] text-gray-400 mt-1">Isi jika ingin langsung membuka chat WhatsApp ke nomor tujuan.</p>
                </div>

                <button type="submit" class="w-full py-2.5 rounded-xl bg-[#753230] text-white font-semibold text-xs tracking-wider uppercase hover:bg-[#8E3A37] transition-all">
                    Buat Link & Teks WhatsApp
                </button>
            </form>
        </div>

        <!-- Result Box -->
        <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm flex flex-col justify-between">
            <div>
                <h3 class="text-base font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                    </svg>
                    <span>Hasil Tautan & Format Pesan</span>
                </h3>

                @if($generatedLink)
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Tautan Khusus Tamu:</label>
                            <div class="flex items-center gap-2">
                                <input type="text" id="target-link" readonly value="{{ $generatedLink }}"
                                       class="flex-1 px-3 py-2 text-xs font-mono bg-gray-50 border border-gray-300 rounded-xl select-all">
                                <button onclick="navigator.clipboard.writeText('{{ $generatedLink }}'); alert('Tautan berhasil disalin!');"
                                        class="px-3 py-2 bg-gray-800 text-white text-xs font-semibold rounded-xl hover:bg-black transition-all">
                                    Salin Link
                                </button>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Format Pesan WhatsApp Siap Kirim:</label>
                            <textarea id="target-message" rows="8" readonly
                                      class="w-full p-3 text-xs font-mono bg-[#FAF4F4] border border-[#B89C7A]/40 rounded-xl leading-relaxed select-all">{{ $generatedMessage }}</textarea>
                        </div>
                    </div>
                @else
                    <div class="py-12 text-center text-gray-400 text-xs">
                        Masukkan nama tamu di formulir sebelah kiri dan klik tombol untuk menghasilkan link undangan.
                    </div>
                @endif
            </div>

            @if($generatedLink)
                <div class="pt-4 border-t flex flex-col sm:flex-row gap-2">
                    <button onclick="navigator.clipboard.writeText(document.getElementById('target-message').value); alert('Teks WhatsApp berhasil disalin!');"
                            class="flex-1 py-2.5 rounded-xl bg-[#753230] text-white font-semibold text-xs hover:bg-[#8E3A37] transition-all text-center">
                        Salin Pesan Lengkap
                    </button>

                    <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer"
                       class="flex-1 py-2.5 rounded-xl bg-emerald-600 text-white font-semibold text-xs hover:bg-emerald-700 transition-all text-center flex items-center justify-center gap-1.5">
                        <span>Kirim via WhatsApp</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>
            @endif
        </div>

    </div>

</div>
@endsection
