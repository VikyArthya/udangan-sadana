@extends('layouts.admin')

@section('title', 'Rekening & Hadiah')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Rekening Bank & Hadiah Fisik</h2>
            <p class="text-xs text-gray-500 mt-1">Kelola rekening bank untuk amplop digital dan alamat pengiriman kado fisik</p>
        </div>
    </div>

    <!-- Alamat Pengiriman Kado Fisik -->
    <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
        <h3 class="text-base font-bold text-[#753230] border-b pb-3 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V6a2 2 0 10-2 2h2zm0 0H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V10a2 2 0 00-2-2h-8z"></path>
            </svg>
            <span>Alamat Pengiriman Kado Fisik</span>
        </h3>

        <form method="POST" action="{{ route('admin.banks.address') }}" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Penerima</label>
                    <input type="text" name="gift_recipient_name" value="{{ old('gift_recipient_name', $setting->gift_recipient_name) }}"
                           placeholder="Habib Yulianto"
                           class="w-full px-3.5 py-2 text-sm rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#753230] focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Nomor Telepon / WhatsApp</label>
                    <input type="text" name="gift_phone" value="{{ old('gift_phone', $setting->gift_phone) }}"
                           placeholder="081234567890"
                           class="w-full px-3.5 py-2 text-sm rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#753230] focus:outline-none">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Alamat Lengkap Pengiriman</label>
                    <textarea name="gift_address" rows="3" placeholder="Jl. ..., RT/RW ..., Kel/Ds ..., Kec ..., Kab ..., Kode Pos ..."
                              class="w-full px-3.5 py-2 text-sm rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#753230] focus:outline-none">{{ old('gift_address', $setting->gift_address) }}</textarea>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-5 py-2 rounded-xl bg-[#753230] text-white text-xs font-semibold hover:bg-[#8E3A37] transition-all">
                    Simpan Alamat Kado
                </button>
            </div>
        </form>
    </div>

    <!-- Daftar Rekening Bank -->
    <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
        <h3 class="text-base font-bold text-gray-800 mb-4">Daftar Rekening Bank Amplop Digital</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
            @foreach($accounts as $account)
                <div class="p-4 rounded-xl border border-gray-200 bg-gray-50 flex items-center justify-between">
                    <div>
                        <span class="px-2.5 py-0.5 rounded-full bg-[#753230] text-white text-[10px] font-bold">
                            {{ $account->bank_name }}
                        </span>
                        <p class="font-mono text-base font-bold text-gray-800 mt-1">{{ $account->account_number }}</p>
                        <p class="text-xs text-gray-500">a.n {{ $account->account_holder }}</p>
                    </div>

                    <form method="POST" action="{{ route('admin.banks.destroy', $account->id) }}" onsubmit="return confirm('Hapus rekening ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 text-rose-600 hover:text-rose-800 rounded-lg hover:bg-rose-50 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

        <!-- Tambah Rekening Form -->
        <div class="border-t pt-6">
            <h4 class="text-sm font-bold text-[#753230] mb-3">+ Tambah Rekening Bank / Dompet Digital Baru</h4>

            <form method="POST" action="{{ route('admin.banks.store') }}" class="grid grid-cols-1 md:grid-cols-3 gap-3">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Bank / E-Wallet</label>
                    <input type="text" name="bank_name" placeholder="BCA / MANDIRI / BRI / DANA" required
                           class="w-full px-3 py-2 text-xs rounded-xl border border-gray-300 focus:outline-none focus:ring-1 focus:ring-[#753230]">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Nomor Rekening / No. HP</label>
                    <input type="text" name="account_number" placeholder="1234567890" required
                           class="w-full px-3 py-2 text-xs rounded-xl border border-gray-300 focus:outline-none focus:ring-1 focus:ring-[#753230]">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Pemilik Rekening (a.n)</label>
                    <input type="text" name="account_holder" placeholder="Habib Yulianto" required
                           class="w-full px-3 py-2 text-xs rounded-xl border border-gray-300 focus:outline-none focus:ring-1 focus:ring-[#753230]">
                </div>

                <div class="md:col-span-3 flex justify-end">
                    <button type="submit" class="px-5 py-2 rounded-xl bg-gray-800 text-white text-xs font-semibold hover:bg-black transition-all">
                        Simpan Rekening Baru
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
