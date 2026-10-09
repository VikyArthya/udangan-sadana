@extends('layouts.admin')

@section('title', 'Buku Tamu & RSVP')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Buku Tamu & Konfirmasi Kehadiran</h2>
            <p class="text-xs text-gray-500 mt-1">Daftar ucapan doa restu dan konfirmasi kehadiran dari para tamu undangan</p>
        </div>

        <!-- Filter tabs -->
        <div class="flex items-center gap-1.5 p-1 bg-gray-200/60 rounded-xl text-xs font-semibold">
            <a href="{{ route('admin.rsvps.index') }}" class="px-3 py-1.5 rounded-lg transition-all {{ empty($status) ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-600 hover:text-gray-900' }}">
                Semua
            </a>
            <a href="{{ route('admin.rsvps.index', ['status' => 'hadir']) }}" class="px-3 py-1.5 rounded-lg transition-all {{ $status === 'hadir' ? 'bg-white text-emerald-700 shadow-sm' : 'text-gray-600 hover:text-gray-900' }}">
                Hadir
            </a>
            <a href="{{ route('admin.rsvps.index', ['status' => 'tidak_hadir']) }}" class="px-3 py-1.5 rounded-lg transition-all {{ $status === 'tidak_hadir' ? 'bg-white text-rose-700 shadow-sm' : 'text-gray-600 hover:text-gray-900' }}">
                Tidak Hadir
            </a>
            <a href="{{ route('admin.rsvps.index', ['status' => 'ragu']) }}" class="px-3 py-1.5 rounded-lg transition-all {{ $status === 'ragu' ? 'bg-white text-amber-700 shadow-sm' : 'text-gray-600 hover:text-gray-900' }}">
                Ragu
            </a>
        </div>
    </div>

    <!-- RSVP Cards/Table -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="divide-y divide-gray-100">
            @forelse($rsvps as $rsvp)
                <div class="p-5 hover:bg-gray-50 flex items-start justify-between gap-4 transition-colors">
                    <div class="space-y-1.5 flex-1">
                        <div class="flex items-center gap-2.5">
                            <h4 class="font-bold text-gray-900 text-sm">{{ $rsvp->name }}</h4>
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold
                                @if($rsvp->attendance === 'hadir') bg-emerald-100 text-emerald-800
                                @elseif($rsvp->attendance === 'tidak_hadir') bg-rose-100 text-rose-800
                                @else bg-amber-100 text-amber-800 @endif">
                                {{ ucfirst(str_replace('_', ' ', $rsvp->attendance)) }}
                                @if($rsvp->attendance === 'hadir') ({{ $rsvp->guest_count }} Pax) @endif
                            </span>
                        </div>
                        <p class="text-xs text-gray-700 leading-relaxed bg-[#FAF4F4] p-3 rounded-xl border border-[#B89C7A]/20">
                            "{{ $rsvp->message }}"
                        </p>
                        <p class="text-[10px] text-gray-400">
                            Dikirim {{ $rsvp->created_at ? $rsvp->created_at->diffForHumans() : 'Baru saja' }}
                        </p>
                    </div>

                    <form method="POST" action="{{ route('admin.rsvps.destroy', $rsvp->id) }}" onsubmit="return confirm('Hapus ucapan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 text-rose-500 hover:text-rose-700 hover:bg-rose-50 rounded-lg transition-all" title="Hapus Ucapan">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            @empty
                <div class="p-12 text-center text-gray-400 text-sm">
                    Tidak ada data ucapan ditemukan.
                </div>
            @endforelse
        </div>

        @if(method_exists($rsvps, 'links'))
            <div class="p-4 border-t border-gray-100">
                {{ $rsvps->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
