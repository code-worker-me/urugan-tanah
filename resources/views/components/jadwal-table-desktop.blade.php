@props(['jadwal', 'urugan' => null])

<div class="hidden md:block overflow-x-auto rounded-2xl border border-blue-100/80 shadow-sm">
    <table class="w-full text-left text-sm">
        <thead class="bg-gradient-to-r from-blue-950 via-blue-900 to-indigo-900 text-white">
            <tr>
                <x-th-table>#</x-th-table>
                <x-th-table>Tanggal & Waktu</x-th-table>
                <x-th-table>Lokasi Proyek</x-th-table>
                <x-th-table>Status Operasional</x-th-table>
                @if($urugan)
                    @can('kantor')
                        <x-th-table text="center">Aksi</x-th-table>
                    @endcan
                @endif
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-slate-100">
            @forelse ($jadwal as $index => $item)
                <tr class="hover:bg-blue-50/50 transition-colors duration-150 group">
                    {{-- Index --}}
                    <td class="px-4 py-3.5 text-xs font-bold text-slate-400">
                        <span class="w-6 h-6 rounded-lg bg-blue-50 text-blue-800 flex items-center justify-center font-bold">
                            {{ method_exists($jadwal, 'firstItem') && $jadwal->firstItem() ? $jadwal->firstItem() + $index : $index + 1 }}
                        </span>
                    </td>

                    {{-- Waktu --}}
                    <td class="px-4 py-3.5 font-semibold text-slate-800 whitespace-nowrap">
                        <div class="flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <span>{{ \Carbon\Carbon::parse($item->waktu)->translatedFormat('d M Y, H:i') }} WIB</span>
                        </div>
                    </td>

                    {{-- Lokasi --}}
                    <td class="px-4 py-3.5 text-slate-700 font-medium">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>{{ $item->urugan->lokasi ?? ($urugan->lokasi ?? '—') }}</span>
                            @if(isset($item->urugan->nama_pt) && !$urugan)
                                <span class="text-xs text-blue-900 bg-blue-50 px-2 py-0.5 rounded-md font-semibold border border-blue-100">
                                    {{ $item->urugan->nama_pt }}
                                </span>
                            @endif
                        </div>
                    </td>

                    {{-- Status --}}
                    <td class="px-4 py-3.5">
                        @if(strtolower($item->status ?? '') === 'kerja')
                            <x-status-badge size="small" color="green">Kerja / Operasional</x-status-badge>
                        @else
                            <x-status-badge size="small" color="slate">Libur / Non-Aktif</x-status-badge>
                        @endif
                    </td>

                    @if($urugan)
                        @can('kantor')
                            <td class="px-4 py-3.5 text-center">
                                <form action="{{ route('jadwalUrugan.delete', [$urugan->id, $item->id]) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 rounded-xl bg-red-50 text-red-600 hover:bg-red-600 hover:text-white font-bold text-xs transition-all duration-150">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        @endcan
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="{{ $urugan ? 5 : 4 }}" class="px-4 py-12 text-center text-slate-400 italic">
                        <div class="flex flex-col items-center gap-2">
                            <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>Belum ada jadwal truk. @if($urugan) Klik "Tambah Jadwal" untuk membuat jadwal baru. @endif</span>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
