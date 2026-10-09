@extends('layouts.admin')

@section('title', 'Love Story')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Perjalanan Cinta (Love Story)</h2>
            <p class="text-xs text-gray-500 mt-1">Kelola tonggak sejarah perjalanan cinta kedua mempelai</p>
        </div>
    </div>

    <!-- Existing Stories -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($stories as $story)
            <div class="bg-white rounded-2xl border border-gray-200 p-5 shadow-sm flex flex-col justify-between">
                <div>
                    @if($story->image)
                        <img src="{{ $story->image }}" alt="{{ $story->title }}" class="w-full h-36 object-cover rounded-xl mb-3">
                    @endif

                    <div class="flex items-center justify-between mb-2">
                        <span class="px-2.5 py-0.5 rounded-full bg-[#FAF4F4] text-[#753230] text-[10px] font-bold border border-[#B89C7A]/40">
                            {{ $story->year_or_date ?? 'Tahap ' . $loop->iteration }}
                        </span>
                        
                        <form method="POST" action="{{ route('admin.stories.destroy', $story->id) }}" onsubmit="return confirm('Hapus cerita ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs text-rose-500 hover:text-rose-700 font-semibold">Hapus</button>
                        </form>
                    </div>

                    <h4 class="font-bold text-gray-900 text-base mb-1">{{ $story->title }}</h4>
                    <p class="text-xs text-gray-600 leading-relaxed mb-4">{{ $story->story }}</p>
                </div>

                <!-- Update Modal/Form toggle -->
                <details class="text-xs border-t pt-3">
                    <summary class="cursor-pointer text-[#753230] font-semibold hover:underline">Edit Cerita Ini</summary>
                    <form method="POST" action="{{ route('admin.stories.update', $story->id) }}" enctype="multipart/form-data" class="mt-3 space-y-2">
                        @csrf
                        @method('PUT')
                        <input type="text" name="year_or_date" value="{{ $story->year_or_date }}" placeholder="Tahun / Fase" class="w-full px-2.5 py-1.5 border rounded-lg text-xs">
                        <input type="text" name="title" value="{{ $story->title }}" required placeholder="Judul" class="w-full px-2.5 py-1.5 border rounded-lg text-xs">
                        <textarea name="story" rows="3" required placeholder="Isi cerita" class="w-full px-2.5 py-1.5 border rounded-lg text-xs">{{ $story->story }}</textarea>
                        <input type="text" name="image" value="{{ $story->image }}" placeholder="URL Gambar" class="w-full px-2.5 py-1.5 border rounded-lg text-xs">
                        <input type="file" name="image_file" accept="image/*" class="text-[11px] text-gray-500">
                        <button type="submit" class="w-full py-1.5 bg-[#753230] text-white rounded-lg text-xs font-semibold">Simpan Perubahan</button>
                    </form>
                </details>
            </div>
        @endforeach
    </div>

    <!-- Add New Story -->
    <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
        <h3 class="text-base font-bold text-[#753230] mb-4 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <span>Tambah Cerita Baru</span>
        </h3>

        <form method="POST" action="{{ route('admin.stories.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Tahun / Judul Fase</label>
                    <input type="text" name="year_or_date" placeholder="Contoh: 2022 / Pertemuan Pertama"
                           class="w-full px-3.5 py-2 text-sm rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#753230] focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Judul Cerita</label>
                    <input type="text" name="title" required placeholder="Contoh: Awal Perkenalan"
                           class="w-full px-3.5 py-2 text-sm rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#753230] focus:outline-none">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Isi Cerita</label>
                    <textarea name="story" rows="3" required placeholder="Tuliskan kisah perjalanan cinta Anda..."
                              class="w-full px-3.5 py-2 text-sm rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#753230] focus:outline-none"></textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Foto Kenangan (URL atau Upload)</label>
                    <input type="text" name="image" placeholder="https://..."
                           class="w-full px-3.5 py-2 text-sm rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#753230] focus:outline-none mb-1.5">
                    <input type="file" name="image_file" accept="image/*" class="text-xs text-gray-500">
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#753230] text-[#FFF0E5] font-semibold text-xs hover:bg-[#8E3A37] transition-all">
                    + Simpan Kisah Cinta
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
