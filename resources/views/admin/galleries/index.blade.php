@extends('layouts.admin')

@section('title', 'Galeri & Video')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Galeri Foto & Video Prewedding</h2>
            <p class="text-xs text-gray-500 mt-1">Kelola foto-foto kenangan prewedding dan tautan video YouTube</p>
        </div>
    </div>

    <!-- Video Prewedding Setting -->
    <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
        <h3 class="text-base font-bold text-[#753230] border-b pb-3 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
            </svg>
            <span>Tautan Video Prewedding (YouTube)</span>
        </h3>

        <form method="POST" action="{{ route('admin.galleries.video') }}" class="flex flex-col sm:flex-row gap-3">
            @csrf
            <input type="text" name="video_url" value="{{ old('video_url', $setting->video_url) }}"
                   placeholder="https://www.youtube.com/watch?v=..."
                   class="flex-1 px-3.5 py-2 text-sm rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#753230] focus:outline-none">
            <button type="submit" class="px-5 py-2 rounded-xl bg-[#753230] text-white text-xs font-semibold hover:bg-[#8E3A37] transition-all">
                Simpan Tautan Video
            </button>
        </form>
    </div>

    <!-- Photos Grid -->
    <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
        <h3 class="text-base font-bold text-gray-800 mb-4">Foto-foto Galeri ({{ count($galleries) }} Foto)</h3>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mb-8">
            @foreach($galleries as $gallery)
                <div class="relative group rounded-xl overflow-hidden border border-gray-200 aspect-square shadow-sm">
                    <img src="{{ $gallery->image_url }}" alt="{{ $gallery->caption }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-between p-3 text-white">
                        <p class="text-[10px] truncate">{{ $gallery->caption ?? 'Foto ' . $loop->iteration }}</p>
                        
                        <form method="POST" action="{{ route('admin.galleries.destroy', $gallery->id) }}" onsubmit="return confirm('Hapus foto ini dari galeri?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full py-1 bg-rose-600 hover:bg-rose-700 text-white rounded text-[11px] font-semibold">
                                Hapus Foto
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Add Photo Form -->
        <div class="border-t pt-6">
            <h4 class="text-sm font-bold text-[#753230] mb-3">+ Tambah Foto Baru ke Galeri</h4>
            <form method="POST" action="{{ route('admin.galleries.store') }}" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-3 gap-3">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">URL Gambar</label>
                    <input type="text" name="image_url" placeholder="https://..."
                           class="w-full px-3 py-2 text-xs rounded-xl border border-gray-300 focus:outline-none focus:ring-1 focus:ring-[#753230]">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Atau Upload Gambar</label>
                    <input type="file" name="image_file" accept="image/*" class="w-full text-xs text-gray-500 pt-1">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Keterangan / Caption</label>
                    <input type="text" name="caption" placeholder="Prewedding Moment..."
                           class="w-full px-3 py-2 text-xs rounded-xl border border-gray-300 focus:outline-none focus:ring-1 focus:ring-[#753230]">
                </div>
                <div class="md:col-span-3 flex justify-end">
                    <button type="submit" class="px-5 py-2 rounded-xl bg-gray-800 text-white text-xs font-semibold hover:bg-black transition-all">
                        Unggah ke Galeri
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
