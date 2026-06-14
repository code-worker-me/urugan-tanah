<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('urugan.view', $urugan) }}"
               class="text-gray-400 hover:text-gray-600 transition">
                   <x-ionicon-chevron-back-outline class="w-5 h-5" />
            </a>
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Jadwal Truk</h2>
                <p class="text-xs text-gray-400 mt-0.5">{{ $urugan->nama_pt }} &mdash; {{ $urugan->lokasi }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-5">
            @if (session('success'))
                <div class="flex items-center gap-3 px-4 py-3 bg-green-50 border border-green-200 rounded-lg text-sm text-green-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Summary Cards --}}
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <x-sum-card title="Sedang Berlangsung / Kerja">
                    <p class="text-2xl font-bold text-indigo-600">
                        {{ $urugan->jadwal()->countKerja() }}
                    </p>
                    <p class="text-xs text-gray-400 mt-0.5">jumlah jadwal</p>
                </x-sum-card>
                <x-sum-card title="Libur">
                    <p class="text-2xl font-bold text-gray-800">
                        {{ $urugan->jadwal()->countLibur() }}
                    </p>
                    <p class="text-xs text-gray-400 mt-0.5">jumlah jadwal</p>
                </x-sum-card>
            </div>

            {{-- Table Card --}}
            <div class="bg-white shadow-sm sm:rounded-xl border border-gray-100">
                <header class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-900">Jadwal truk <span class="text-green-700">{{ $urugan->nama_pt }}</span></h3>
                    @can('kantor')
                    <x-button-link href="{{ route('jadwalUrugan.create', $urugan) }}">Tambah Jadwal</x-button-link>
                    @endcan
                </header>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <x-th-table>#</x-th-table>
                                <x-th-table>Tanggal</x-th-table>
                                <x-th-table>Lokasi</x-th-table>
                                <x-th-table>Status</x-th-table>
                                @can('kantor')
                                <x-th-table text="center">Aksi</x-th-table>
                                @endcan
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 bg-white">
                            @forelse ($jadwal as $i => $item)
                                <tr class="hover:bg-gray-50 transition">
                                    {{-- Nomor Urut --}}
                                    <td class="px-4 py-3 text-gray-400">
                                        {{ $jadwal->firstItem() + $i }}
                                    </td>

                                    {{-- Tanggal --}}
                                    <td class="px-4 py-3 text-gray-600 whitespace-nowrap">
                                        {{ $item->waktu->translatedFormat('d M Y, H:i') }}
                                    </td>

                                    {{-- Lokasi --}}
                                    <td class="px-4 py-3 text-gray-600">
                                        {{ $urugan->lokasi }}
                                    </td>

                                    {{-- Status Badge (Disamakan dengan x-status-badge) --}}
                                    <td class="px-4 py-3">
                                        @if($item->status === 'kerja')
                                            <x-status-badge size="small" padd="small" color="green">Kerja</x-status-badge>
                                        @else
                                            <x-status-badge size="small" padd="small" color="gray">Libur</x-status-badge>
                                        @endif
                                    </td>

                                    @can('kantor')
                                    {{-- Kolom Action Komponen --}}
                                    <td class="px-4 py-3 text-center">
                                        <form action="{{ route('jadwalUrugan.delete', [$urugan->id, $item->id]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 font-medium transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                    @endcan
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-12 text-center text-gray-400 italic">
                                        Belum ada jadwal. Klik "Tambah Jadwal" untuk memulai.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination Links --}}
                @if ($jadwal->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100">
                        {{ $jadwal->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
