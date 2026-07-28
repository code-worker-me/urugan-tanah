@props(['jadwal', 'urugan' => null])

<div class="block md:hidden space-y-4">
    @forelse ($jadwal as $index => $item)
        <div class="bg-white rounded-2xl p-5 border border-blue-100/80 shadow-sm space-y-4 relative overflow-hidden">
            <!-- Left status border -->
            <div class="absolute left-0 top-0 bottom-0 w-1.5 {{ strtolower($item->status ?? '') === 'kerja' ? 'bg-emerald-500' : 'bg-slate-300' }}"></div>

            <div class="flex items-center justify-between gap-3 pl-2">
                <div class="flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-blue-50 text-blue-900 font-extrabold flex items-center justify-center text-xs border border-blue-100">
                        #{{ method_exists($jadwal, 'firstItem') && $jadwal->firstItem() ? $jadwal->firstItem() + $index : $index + 1 }}
                    </span>
                    @if(isset($item->urugan->nama_pt) && !$urugan)
                        <span class="text-xs text-blue-950 font-bold bg-blue-50 px-2 py-1 rounded-lg border border-blue-100">
                            {{ $item->urugan->nama_pt }}
                        </span>
                    @endif
                </div>

                <div>
                    @can('kantor')
                        @if($urugan)
                            <form action="{{ route('jadwalUrugan.updateStatus', [$urugan->id, $item->id]) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()"
                                        class="text-xs font-bold rounded-xl px-2.5 py-1 border transition cursor-pointer shadow-2xs {{ strtolower($item->status ?? '') === 'kerja' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-slate-100 text-slate-700 border-slate-200' }}">
                                    <option value="kerja" {{ strtolower($item->status ?? '') === 'kerja' ? 'selected' : '' }}>⚡ Kerja</option>
                                    <option value="libur" {{ strtolower($item->status ?? '') === 'libur' ? 'selected' : '' }}>☕ Libur</option>
                                </select>
                            </form>
                        @else
                            @if(strtolower($item->status ?? '') === 'kerja')
                                <x-status-badge size="small" color="green">Kerja</x-status-badge>
                            @else
                                <x-status-badge size="small" color="slate">Libur</x-status-badge>
                            @endif
                        @endif
                    @else
                        @if(strtolower($item->status ?? '') === 'kerja')
                            <x-status-badge size="small" color="green">Kerja</x-status-badge>
                        @else
                            <x-status-badge size="small" color="slate">Libur</x-status-badge>
                        @endif
                    @endcan
                </div>
            </div>

            <div class="pl-2 space-y-2 text-xs">
                <!-- Tanggal & Waktu -->
                <div class="flex items-center gap-2 text-slate-800 font-semibold bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                    <svg class="w-4 h-4 text-blue-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>{{ \Carbon\Carbon::parse($item->waktu)->translatedFormat('d M Y, H:i') }} WIB</span>
                </div>

                <!-- Lokasi -->
                <div class="flex items-center gap-2 text-slate-600 font-medium">
                    <svg class="w-4 h-4 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="truncate">{{ $item->urugan->lokasi ?? ($urugan->lokasi ?? '—') }}</span>
                </div>
            </div>

            @if($urugan)
                @can('kantor')
                    <div class="pt-3 border-t border-slate-100 flex items-center justify-end pl-2">
                        <form action="{{ route('jadwalUrugan.delete', [$urugan->id, $item->id]) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full sm:w-auto px-4 py-1.5 rounded-xl bg-red-50 text-red-600 hover:bg-red-600 hover:text-white font-bold text-xs transition-all duration-150 flex items-center justify-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                <span>Hapus Jadwal</span>
                            </button>
                        </form>
                    </div>
                @endcan
            @endif
        </div>
    @empty
        <div class="bg-white rounded-2xl p-8 border border-blue-100/80 shadow-sm text-center text-slate-400 italic">
            <div class="flex flex-col items-center gap-2">
                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span>Belum ada jadwal truk. @if($urugan) Klik "Tambah Jadwal" untuk membuat jadwal baru. @endif</span>
            </div>
        </div>
    @endforelse
</div>
